<?php

/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 28/12/17
 * Time: 08:26 AM
 *
 * Responde y envía en un documento las siguientes preguntas:
 *
 * 1. ¿En qué consiste el principio de responsabilidad única? ¿Cuál es su propósito?
 *
 * El principio de responsabilidad única es uno de los los 5 principios (SOLID) que se aplican al enfoque orientado a objetos y consiste en delegar en un componente (clase, objeto, módulo)
 * sólo una única responsabilidad lo cuál garantiza una alta cohesión de sus elementos internos (métodos, atributos, constantes) y un bajo acoplamiento
 * (dependencia de otros componentes externos) favoreciendo la reúsabilidad y abstracción de responsabilidades de una aplicación. Por ejemplo la clase "Customer" podría implementar un método
 * "updateCustomer()" pero no un método "sendMessage()" porque estaríamos delegando en "Customer" una responsabilidad  que no le corresponde, entonces customer tendría dos responsabilidades,
 * lo cuál incrementaría el nivel de acoplamiento con otras clases que requieran la funcionalidad "sendMessage()" e internamente tendríamos dos operaciones separadas e independientes que
 * desfavorecerían la rehusabilidad.
 *
 *
 * 2. ¿Qué características tiene según tu opinión “buen” código o código limpio?
 *
 * a.- Cada operación individual debe estar debidamente documentada.
 * b.- Las variable, constantes, funciones y clases deben tener nombres sugerentes a su uso y operación.
 * c.- Se debe utilizar una nomeclatura correcta y uniforme en todo el código (camelCase, snake_case).
 * d.- Los nombres de las clases deber guardar estrecha relación con los conceptos de negocio (modelo de objetos del dominio), jamás deben ser verbos.
 * e.- Los nombres de funciones deber representar operaciones y deben comenzar siempre por un verbo en infinitivo, ejemplo: "ConfirmarServicio", "EnviarNotificacion".
 * f.- Nunca quemar (hardcode) datos en el código fuente, lo ideal es utilizar properties y/o configuraciones.
 * g.- Nombrar elementos y documentar en un único idioma (preferiblemente inglés).
 * h.- No dejar hints (salidas y logs colocados para depuración).
 * i.- No dejar código comentado.
 * j.- Utilizar TODO para documentar código inconcluso que debe actualizarse a posteriori.
 * k.- Utilizar correctamente el sangrado.
 * l.- Las funciones debe realizar una única operación.
 * m.- Evitar líneas muy largas
 * n.- No repetir nombres de variables, funciones, clases, namespaces, etc.
 * o.- Documentar con ejemplos las entradas y salidas.
 * p.- Dejar trazas logs de inicio, culminación y excepciones en la ejecución de operaciones.
 *
 */

use \App\Service;
use \App\Driver;
use \App\AppProperties;
use \App\Response;
use \App\Input;
use \App\Push;

class ServiceController
{
    /* Confirmación de servicio
     *
     * El siguiente código muestra el método de un controlador que:
     * 1. Recibe dos parámetros por POST: El id de un servicio, el id de un conductor
     * 2. Cambia el estado de varias entidades en la base de datos basado en la lógica del negocio.
     * 3. Envía notificaciones y retorna una respuesta.
     *
     * @return json object con información de la respuesta
     */
    public function ConfirmService(){
        $service = Service::find(Input::get('service_id'));
        $driver = Driver::find(Input::get('driver_id'));
        $config = new AppProperties;

        if($service){
            if($service->status_id == $config->get('service.status_6'))
                return Response::json(array('error' => $config->get('error_status_2')));
            if(!$service->$driver->id && $service->status_id == $config->get('service_status_1')){
                $driver->fill(['available' => '0'])->save();
                $service->fill([
                    'driver_id' => $driver->id,
                    'status_id' => $config->get('service_status_2'),
                    'car_id' => $driver->car_id])->save();
                $pushMessage = $config->get('messages_confirmed');
                $push = Push::make();
                if($service->user->uuid == '')
                    return Response::json(array('error' => $config->get('error_status_0')));
                //TODO: Add try-catch block after implements a properly exception handler
                if($service->user->type == '1')
                    $push->ios($service->user->uuid, $pushMessage, 1, $config->get('assets_sound_1'), 'Open', array('serviceId' => $service->id));
                else
                    $push->android2($service->user->uuid, $pushMessage, 1, $config->get('assets_sound_default'), 'Open', array('serviceId' => $service->id));
                return Response::json(array('error' => $config->get('error_status_0')));
            } else
                return Response::json(array('error' => $config->get('error_status_1')));
        } else
            return Response::json(array('error' => $config->get('error_status_3')));
    }
}

/*
 * ################################### Refactorización de código ##################################################
 *
 * El código mostrado arriba muestra algunas mejoras respecto al código original, las cuales se describen a continuación:
 *  - El código original se excede en uso de Facades, por el contrario en el código actualizado, aunque no se suprime el uso de facades para trabajar con instancias del
 *    modelo, se delega la responsabilidad de el suministro de atributos y operaciones a un objeto creado a pertir de la clase facade.
 *  - Se añadió un property manager para administrar códigos de error, estados y mensajes en forma de propiedades preconfiguradas, en el código original se mostraban quemados
 *    (hardcodded), esta es una práctica que debemos evitar en lo posible porque afecta de manera muy sensible la mantenibilidad y seguridad del código.
 *  - Se suprimieron algunas instrucciones innecesarias como la re-instanciación de objetos y asignación de variable que son usadas una sola vez.
 *  - Se actualizaron los mecanismos de actualización de entidades para optimizar el uso del ORM Eloquent de laravel.
 *  - Se suprimió todo el código comentado y se agregó la documentación formal de la operación.
 *
 * IMPORTANTE CONSIDERAR:
 *  - Creación de un mecanismo de manejo de properties.
 *  - Diseñar, crear e implementar un manejador de excepciones que reemplace la devolución de códigos de error.
 *
 * MEJORAS LUEGO DE LA REFACTORIZACIÓN:
 *  - Optimización del uso del ORM
 *  - Mejoras en la veliocidad de ejecución porque se simplificaron algunas instrucciones.
 *  - Mejor legilibilidad del código porque se eliminaron tanto la delimitación innecesaria de bloques como el código comentado.
 *  - Se documentó correctamente la operación.
 *  - Se actualizarizaron los nombre de funciones y variables en un idioma único y con una nomeclatura estandard
 *
 */