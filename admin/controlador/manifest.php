<?php 
session_start();
include("conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";
$resultado = mysqli_query($cn, $consulta);
while ($data = mysqli_fetch_assoc($resultado)) {
  $AMP = json_decode($data['movil'], true);


$code_manifest ='
{
    "name": "'.$AMP['nombre_app'].'",
    "short_name": "'.$AMP['nombre_corto'].'",
    "description": "'.$AMP['descripcion'].'",
    "background_color": "'.$AMP['color_fondo'].'",
    "theme_color": "'.$AMP['theme_color'].'",
    "orientation": "portrait",
    "display": "standalone",
    "start_url": "./?utm_source=web_app_manifest",
    "scope": "./",
    "lang": "es-MX",
    "icons": [
      {
        "src": "'.$AMP['icono_1024'].'",
        "sizes": "1024x1024",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_512'].'",
        "sizes": "512x512",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_384'].'",
        "sizes": "384x384",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_256'].'",
        "sizes": "256x256",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_192'].'",
        "sizes": "192x192",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_128'].'",
        "sizes": "128x128",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_96'].'",
        "sizes": "96x96",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_64'].'",
        "sizes": "64x64",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_32'].'",
        "sizes": "32x32",
        "type": "image/png"
      },
      {
        "src": "'.$AMP['icono_16'].'",
        "sizes": "16x16",
        "type": "image/png"
      }
    ]
  }
';
}

$fp = fopen("../../manifest.json", "a+");
$file_manifest  = fopen("../../manifest.json", "w+");

fwrite($file_manifest,$code_manifest  . PHP_EOL);
fclose($file_manifest);

echo "1";

?>