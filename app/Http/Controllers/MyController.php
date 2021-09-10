<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MyController extends Controller
{

    public function getConteneurInfos(Request $request){

        $conteneur = $request->input('numeroConteneur');
        if ($conteneur == null){
            return view('home', ['error' => "Le numéro de conteneur entré est vide"]);
        }
        $ch = curl_init("https://gestiondecolis.firebaseio.com/trajet_colis/".$conteneur.".json");
        $header=array('Content-Type: application/json');

        curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json_response = curl_exec($ch);
        $response = json_decode($json_response, true);

        if ($response != null){
            $positionActu = "";
            if ($response['partie_deux']['statut'] != null && $response['partie_deux']['statut'] == 'terminer')
                $positionActu = "Port (Havre)";
            if ($response['partie_trois']['statut'] != null && $response['partie_trois']['statut'] == 'terminer')
                $positionActu = "Dans le bateau";
            if ($response['partie_quatre']['statut'] != null && $response['partie_quatre']['statut'] == 'terminer')
                $positionActu = "Port de Lome";
            if ($response['partie_cinq']['statut'] != null && $response['partie_cinq']['statut'] == 'terminer')
                $positionActu = "En route pour douane de Ouagadougou";
            if ($response['partie_six']['statut'] != null && $response['partie_six']['statut'] == 'terminer')
                $positionActu = "Douane de Ouagadougou";
            if ($response['partie_sept']['statut'] != null && $response['partie_sept']['statut'] == 'terminer')
                $positionActu = "Mise à disposition et livraison";

            $ch = curl_init("https://gestiondecolis.firebaseio.com/date_depart_et_arrive/arrive.json");
            $header=array('Content-Type: application/json');

            curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $time = strtotime(substr($response['partie_deux']['date'], 0, 11));
//            dd(substr($response['partie_deux']['date'], 0, 10));
            $dateEstime = date_add(DateTime::createFromFormat('d/m/Y', substr($response['partie_deux']['date'], 0, 10)), date_interval_create_from_date_string("35 days"));
            $dateEstime = $dateEstime->format("d/m/Y");

            $json_response = curl_exec($ch);
            $response_date_estime = json_decode($json_response, true);
//        return $response_date_estime['annee'];
            $date = $response_date_estime['jour'] . "-" . $response_date_estime['mois'] . "-" . $response_date_estime['annee'];
//        echo $response['partie_cinq']['date'];
            return view('home', ['conteneurData' => $response, 'numeroConteneur' => $conteneur, 'dateEstime' => $dateEstime, "positionActu" => $positionActu]);
        }else{
            return view('home', ['error' => "Aucun conteneur trouvé avec le numéro entré"]);
        }


//        echo $response;

//        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $response = json_decode($json_response, true);
//        curl_close($ch);
//
//        if ( $status == 201 or $status == 200 ) {
//            echo response()->json(["colis response" => ["status" => $this->SUCCESS_STATUS]]);
//        }else echo $json_response;
    }

    public function saveMessage(Request $request){
        $date = Carbon::now();
        $message = new Message();
        $message->nom = $request->input('nom');
        $message->message = $request->input('message');
        $message->email = $request->input('email');
        $message->numero = $request->input('numero');
        $message->prenom = $request->input('prenom');
        $message->date = $date->toDateTimeString();
        if($message->save()){
            return redirect()->route('message_envoye')->with('result', 'Votre message à été envoyé avec succès et vous recevrez une réponse dans un délais de 2 jours ouvrables! Vous trouvez ce temps long, éssayez de nous appeler : +33 7 54 14 14 80');
        }
        else{
            return redirect()->route('message_envoye')->with('result', 'Une erreur s\'est produite lors de l\'envoie de votre message, veuillez réessayer!');
        }
    }

    public function howItWorks(){
        return view("howItWorks");
    }
}
