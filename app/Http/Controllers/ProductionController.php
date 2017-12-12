<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductionController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

      public function showGeral()
      {
          $true = true;
         if($true){
           $all = DB::table('users')
             ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
             ->join('insurers', 'insurers.id', '=', 'intermediations.id_insurer')
             ->join('brokerages', 'brokerages.id', '=', 'intermediations.id_brokerage')
             ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
             ->get(array('users.name as users_name', 'brokerages.name as brokerages_name', 'insurers.name as insurers_name', 'intermediations.id as intermediations_id', 'productivities.value as productivities_value'));

           $allInsurers = DB::table('insurers')
             ->get(array('insurers.name as insurers_name'));

           $allDates = DB::table('users')
           ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
           ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
             ->get(array('productivities.date as productivities_data'));

           $allBrokers = DB::table('users')
             ->get(array('users.id as users_id', 'users.name as users_name' ));

           $arrayTableProducao = ProductionController::arrayTableProducao($all,$allInsurers);
           $arrayTableInsurers = ProductionController::arrayTableInsurers($allInsurers);

           return view('producao', ['producao' => $arrayTableProducao, 'insurers' => $arrayTableInsurers, 'dates' => $allDates, 'brokers' => $allBrokers, 'errors' => '']);
         }else{
           return view('producao', ['errors' => 'Usuário não possui permissão para ver esses dados']);
         }
      }

      public function show($id)
      {
          if($id == Auth::id() || $id == $id){
            $all = DB::table('users')
              ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
              ->join('insurers', 'insurers.id', '=', 'intermediations.id_insurer')
              ->join('brokerages', 'brokerages.id', '=', 'intermediations.id_brokerage')
              ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
              ->where('users.id', '=', $id)
              ->get(array('users.name as users_name', 'brokerages.name as brokerages_name', 'insurers.name as insurers_name', 'intermediations.id as intermediations_id', 'productivities.value as productivities_value'));

            $allInsurers = DB::table('insurers')
              ->get(array('insurers.name as insurers_name'));

            $allDates = DB::table('users')
            ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
            ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
              ->where('users.id', '=', $id)
              ->get(array('productivities.date as productivities_data'));

            $allBrokers = DB::table('users')
              ->get(array('users.id as users_id', 'users.name as users_name' ));

            $arrayTableProducao = ProductionController::arrayTableProducao($all,$allInsurers);
            $arrayTableInsurers = ProductionController::arrayTableInsurers($allInsurers);

            return view('producao', ['producao' => $arrayTableProducao, 'insurers' => $arrayTableInsurers, 'dates' => $allDates, 'brokers' => $allBrokers, 'errors' => '']);
          }else{
            return view('producao', ['errors' => 'Usuário não possui permissão para ver esses dados']);
          }
      }

      public function showData($id,$ano,$mes='')
      {
          if($mes){
            $datemin = $ano.'-'.$mes.'-01';
            $datemax = $ano.'-'.$mes.'-31';
          }else{
            $datemin = $ano.'-'.'01'.'-01';
            $datemax = $ano.'-'.'12'.'-31';
          }

          $true = true;
          if($true){
            $all = DB::table('users')
              ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
              ->join('insurers', 'insurers.id', '=', 'intermediations.id_insurer')
              ->join('brokerages', 'brokerages.id', '=', 'intermediations.id_brokerage')
              ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
              ->where('users.id', '=', $id)
              ->where('productivities.date', '>=', $datemin)
              ->where('productivities.date', '<=', $datemax)
              ->get(array('productivities.date as productivities_data','users.name as users_name', 'brokerages.name as brokerages_name', 'insurers.name as insurers_name', 'intermediations.id as intermediations_id', 'productivities.value as productivities_value'));

            $allDates = DB::table('users')
            ->join('intermediations', 'users.id', '=', 'intermediations.id_user')
            ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
              ->where('users.id', '=', $id)
              ->get(array('productivities.date as productivities_data', 'intermediations.id as intermediations_id'));

            $allBrokers = DB::table('users')
              ->get(array('users.id as users_id', 'users.name as users_name' ));

            $allInsurers = DB::table('insurers')
              ->get(array('insurers.name as insurers_name'));

            $arrayTableProducao = ProductionController::arrayTableProducao($all,$allInsurers);
            $arrayTableInsurers = ProductionController::arrayTableInsurers($allInsurers);

            return view('producao', ['producao' => $arrayTableProducao, 'insurers' => $arrayTableInsurers, 'dates' => $allDates, 'brokers' => $allBrokers, 'errors' => '']);
          }else{
            return view('producao', ['errors' => 'Usuário não possui permissão para ver esses dados']);
          }
      }

      public function getIntermediation($idintermediation)
      {
          if($idintermediation == Auth::id() || $idintermediation == $idintermediation){
            $allIntermediations = DB::table('intermediations')
              ->join('users', 'users.id', '=', 'intermediations.id_user')
              ->join('insurers', 'insurers.id', '=', 'intermediations.id_insurer')
              ->join('brokerages', 'brokerages.id', '=', 'intermediations.id_brokerage')
              ->join('productivities', 'productivities.id_intermediation', '=', 'intermediations.id')
              ->where('intermediations.id', '=', $idintermediation)
              //->where('productivities.date', '>=', $datemin)
              //->where('productivities.date', '<=', $datemax)
              ->get(array('productivities.date as productivities_data','users.name as users_name', 'brokerages.name as brokerages_name', 'insurers.name as insurers_name', 'productivities.value as productivities_value'));

            $relation = DB::table('intermediations')
              ->join('insurers', 'insurers.id', '=', 'intermediations.id_insurer')
              ->join('brokerages', 'brokerages.id', '=', 'intermediations.id_brokerage')
              ->where('intermediations.id', '=', $idintermediation)
              //->where('productivities.date', '>=', $datemin)
              //->where('productivities.date', '<=', $datemax)
              ->get(array('insurers.name as insurers_name', 'brokerages.name as brokerages_name'));

            $all = self::htmlintermediations($allIntermediations, $relation);
            return $all;

          }else{
            return view('addproducao', ['errors' => 'Usuário não possui permissão para ver esses dados']);
          }
      }

      public function htmlintermediations($allIntermediations, $relation){
        $total = 0;
        $html = '';
        $html .= '<div class="intermediations_header">';
          $html .= '<span class="insurer">'.$relation[0]->insurers_name.'</span> - <span class="brokerage">'.$relation[0]->brokerages_name.'</span>';
        $html .= '</div>';

        $html .= '<div class="intermediations_form">';
          $html .= '<form class="" action="index.html" method="post">';
            $html .= '<input type="text" name="data" value="" placeholder="Data:">';
            $html .= '<input type="text" name="value" value="" placeholder="Valor:">';
            $html .= '<input type="submit" name="" value="">';
          $html .= '</form>';
        $html .= '</div>';

        $html .= '<div class="intermediations_footer">';
          $html .= '<h5>Evolução Mensal</h5>';
          $html .= '<table>';
            $html .= '<tr>';
              $html .= '<th>Data</th>';
              $html .= '<th>Produção do Dia</th>';
              $html .= '<th>Total</th>';
              $html .= '<th>Ação</th>';
            $html .= '</tr>';
            foreach ($allIntermediations as $key => $item) {
              $total = $total + $item->productivities_value;
              $html .= '<tr>';
                $html .= '<th>'.$item->productivities_data.'</th>';
                $html .= '<th>'.$item->productivities_value.'</th>';
                $html .= '<th>'.$total.'</th>';
                $html .= '<th>link</th>';
              $html .= '</tr>';
            }
          $html .= '</table>';
        $html .= '</div>';

        return $html;
      }

      static function arrayTableProducao($all,$allInsurers){
          $return = array();
          foreach ($all as $key => $items) {
            if(!array_key_exists($items->brokerages_name,$return)){
                $return[$items->brokerages_name] = array();
            }
            if(!array_key_exists($items->insurers_name,$return[$items->brokerages_name])){
                foreach ($allInsurers as $keyInsurers => $valueInsurers) {
                    $return[$items->brokerages_name][$valueInsurers->insurers_name] = array(0,0);
                }
            }
            $return[$items->brokerages_name][$items->insurers_name][0] = $return[$items->brokerages_name][$items->insurers_name][0] + $items->productivities_value;
            $return[$items->brokerages_name][$items->insurers_name][1] = $items->intermediations_id;

          }
          return $return;
      }

      static function arrayTableInsurers($allInsurers){
          $return = array();
          foreach ($allInsurers as $key => $items) {
            $return[$items->insurers_name] = $key;
          }
          return $return;
      }


}
