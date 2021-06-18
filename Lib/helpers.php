<?php
@session_start();

function redirect($url){
	echo "<script type='text/javascript'>
	window.location.href='$url';</script>";
}

function dd($variable){
	echo "<pre>";
	die(print_r($variable));
}


function getUrl($modulo,$controlador,$funcion,$parametros=false, $ajax=false)
{
    // if($ajax==false)
    // {
    //     $pagina="index";
    // }
    // else
    // {
    //     $pagina="ajax";
    // }

    // $url="$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
    $url="index.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";


    // if($parametros!=false){
    //         foreach($parametros as $key=>$valor){
    //                 $url.="&$key=$valor";
    //         }
    // }

    return $url;
}

function loadForms()
{

  if(!isset($_GET['modulo']) && !isset($_GET['controlador']) && !isset($_GET['funcion'])){
    //echo "llega aqui";
    @include '../view/dashboard/inicio.php';
  }
  else
  {

    $modulo= ucwords($_GET['modulo']);
    $controlador= ucwords($_GET['controlador']);
    $funcion= $_GET['funcion'];
    //echo "<h3>la ruta que llega ---> MODULO: ".$modulo." CONTROLADOR: ".$controlador."</h3>";

    if(is_dir("../Controller/" . $modulo))
    {
      if(file_exists("../Controller/" . $modulo . "/" . $controlador . "Controller.php"))
      {
        include_once('../Controller/' . $modulo . '/' . $controlador .'Controller.php');
        $nombreClase= $controlador ."Controller";
        $objcontrolador= new $nombreClase();

        if(method_exists($objcontrolador,$funcion))
        {
          $objcontrolador->$funcion();
        }
        else
        {
          echo ("La funcion especificada no existe");
        }

      }
      else
      {
        echo("El controlador especificado no existe");
      }
    }
    else
    {
      echo ("El modulo especificado no existe");
    }
  }
}








