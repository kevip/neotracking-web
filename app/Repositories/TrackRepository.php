<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Models\Tienda;
use App\Models\TrackImagen;
use App\Models\Role;

use App\Models\TrackStatus;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use Carbon\Carbon;

use App\Models\Track;
use App\Models\StockStatus;

use Symfony\Component\HttpFoundation\Response;



class TrackRepository
{

    private $TRACKING_STATUS = [
        "Alta" =>1,
        "Baja" =>2,
        "Pendiente"=>3
    ];

    public function baja(Request $request, $id){
        return $this->cambiarEstado($this->TRACKING_STATUS["Baja"], $id);
    }

    /**
     * @param $status
     * @param $id
     * @return mixed
     */
    private function cambiarEstado($status, $id){
        $user_id = \Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        $authorized = false;
        $track = Track::find($id);
        if (!is_null($user)) {
            foreach ($user->roles as $key => $role) {
                if ($role->name == "Administrador") {
                    $authorized = true;
                }
            }
            if($authorized){
                $track->status = $status;
                $track->save();
            }
        }

        return $track;
    }

    /**
     * @param $codigo
     * @return Stock
     */
    private function createStockOnTrack($codigo, $tienda, $phone_number){

        $user = User::where('phone_number', $phone_number)->first();
        if($user) {
            if($user->status=="pendiente") {
                $status_pendiente = StockStatus::where('name', '=', 'pendiente_alta')->first();
            }else{
                $status_pendiente = StockStatus::where('name', '=', 'pendiente_alta_puede_editar')->first();
            }
        }else
            $status_pendiente = StockStatus::where('name', '=', 'pendiente_alta')->first();
        /*$stock = new Stock();
        $stock->codigo = $codigo;
        $stock->tienda_id = $tienda;
        $stock->status = $status_pendiente->id;
        $stock->save();*/
        $stock = Stock::create([
            'codigo' => $codigo,
            'tienda_id' => $tienda,
            'status' => $status_pendiente->id
        ]);
        Log::debug("Nuevo mobiliario:". $stock->id);
        return $stock;
    }

    /**
     * @param $phone_number
     * @return User
     */
    private function createUserOnTrack($phone_number){
        $user = User::create([
            "phone_number" => $phone_number
        ]);
        $rol = Role::where('name','Supervisor')->first();
        $user->roles()->attach($rol->id);
        Log::debug("Usuario nuevo: ".$user->id);
        return User::find($user->id);
    }
    /**
     * @param $id
     * @return Track
     */
    public function show($id)
    {
        return Track::with(['tienda', 'trackImagen'])->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {


        $tienda = 1;
        if($request->get('tienda')!=null) {
            $tienda = $request->get('tienda');
        }
        Log::debug("Tienda: ".$tienda);
        Log::debug("all: ". json_encode($request->except(['photo1', 'photo2', 'photo3' ,'photo4'])));
        $codigo = $request->get('codigo');
        Log::debug("codigo:". $codigo);
        $stock = Stock::where('codigo', $codigo)->first();
        if(empty($stock)) {
            $stck = $this->createStockOnTrack($codigo, $tienda, $request->get('num'));
        }else if($request->get('flag')=='Baja') {
            $this->sugerirBaja($stock);
            Log::debug("Se sugirio la baja");
        }

        $phone_number = $request->get('num');
        $usr = User::where('phone_number', $phone_number)->first();
        Log::debug("Teléfono usuario:". $phone_number);
        if(empty($usr)) {
            $usr = $this->createUserOnTrack($phone_number);
        }

        $m = new Track();
        $m->codigo = $codigo;
        $m->tienda_id = $tienda;
        $m->obs  = $request->get('obs');
        $m->lat  = $request->get('lat');
        $m->flag = $request->get('flag');
        $m->guid = $request->get('guid');
        $m->lng  = $request->get('lng');
        $m->num  = $request->get('num');
        $m->usr  = $usr->id;

        if($usr->first_name){
            $m->user_first_name = $usr->first_name;
        }
        if($usr->last_name){
            $m->user_last_name = $usr->last_name;
        }
        if($usr['status'] =='pendiente') {
            $t_status = TrackStatus::where('name', 'pendiente')->first();
        }
        else
            $t_status = TrackStatus::where('name','alta')->first();

        $m->status_id = $t_status->id;
        $m->save();

        Log::debug("Nuevo track: ".$m->guid);

        $this->cambiarTiendaMobiliario($m);

        $now = Carbon::now();
        $timestamp = $now->timestamp;
        if($request->get('photo1') != null) {
            Log::debug("Subiendo foto1... ");
            $imageName = $m->id. '_1_' .$timestamp. '.jpg';
            $img = base64_decode($request->get('photo1'));
            $path_image =base_path() . '/public/images/' . $imageName;
            file_put_contents( $path_image, $img);
            //Storage::disk('public_image')->put($imageName, $img);
            $photo1 = $this->regPhoto($m->id, $imageName, $path_image);

        }
        if($request->get('photo2') != null) {
            Log::debug("Subiendo foto2... ");
            $imageName = $m->id. '_2_' .$timestamp. '.jpg';
            $img = base64_decode($request->get('photo2'));
            $path_image =base_path() . '/public/images/' . $imageName;
            file_put_contents( $path_image, $img);
            $photo1 = $this->regPhoto($m->id, $imageName, $path_image);

        }
        if($request->get('photo3') != null) {
            Log::debug("Subiendo foto3... ");
            $imageName = $m->id. '_3_' .$timestamp. '.jpg';
            $img = base64_decode($request->get('photo3'));
            $path_image =base_path() . '/public/images/' . $imageName;
            file_put_contents( $path_image, $img);
            $photo1 = $this->regPhoto($m->id, $imageName, $path_image);
        }
        if($request->get('photo4') != null) {
            Log::debug("Subiendo foto4... ");
            $imageName = $m->id. '_4_' .$timestamp. '.jpg';
            $img = base64_decode($request->get('photo2'));
            $path_image =base_path() . '/public/images/' . $imageName;
            file_put_contents( $path_image, $img);
            $photo1 = $this->regPhoto($m->id, $imageName, $path_image);
        }
        //$this->em->detach($m);
        return response()->json(array('code' => $m->codigo));
    }

    /**
     * @param $track_id
     * @param $file
     * @param $imageName
     * @return TrackImagen
     */
    private function regPhoto($track_id, $name, $imageName){
        $img = new TrackImagen();
        $img->track_id = $track_id;

        $img->type = 'jpg';

        $img->name = $name;

        $img->url = 'http://lg.neoprojects.com.pe/images/' . $name;

        $img->save();
        Log::debug("Se subio imagen");
        return $img;
    }

    private function sugerirBaja(Stock $stock){
        $status_pendiente = StockStatus::where('name','=','pendiente_baja')->first();
        $stock->status = $status_pendiente->id;
        $stock->save();
    }

    /**
     * Cambia la ubicacion del mueble cuando un supervisor hace tracking si el mueble esta en estado de 'alta',
     * el tracking tambien debera estar en estado de 'alta'
     * @param $track
     */
    private function cambiarTiendaMobiliario($track){
        $stock = Stock::with(['stockStatus'])->where('codigo',$track->codigo)->first();
        $s = $stock->toArray();
        $track_status_alta = TrackStatus::where('name', 'alta')->first();
        //if($s['stock_status']['name']=='alta'){
            /*
             * Si el tracking esta en estado de 'alta' se asigna la tienda donde se hizo el tracking al mueble
             */
            if($track->status_id == $track_status_alta->id){
                $stock->tienda_id = $track->tienda_id;
                $stock->save();
            }
        //}
    }

}