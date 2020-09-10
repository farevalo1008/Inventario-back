<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return response()->json("Bienvenido a la API de SOAINT");
});

Route::group(['prefix' => '/soaint/api/', 'middleware' => ['cors']], function () {

    //LISTAS ESTATICAS
    Route::get('getpais', 'ListController@getPais');
    Route::get('getdescripciontrabajo', 'ListController@getDescripcionTrabajo');
    Route::get('getgenero', 'ListController@getGenero');
    Route::get('getroles', 'ListController@getRoles');
    Route::get('getprofesion', 'ListController@getProfesion');
    Route::get('getcargos', 'ListController@getCargos');
    Route::get('getestadocivil', 'ListController@getEstadoCivil');
    Route::get('getidiomas', 'ListController@getIdiomas');
    Route::get('getmodulos', 'ListController@getModulos');
    Route::get('getnivel', 'ListController@getNivel');
    Route::get('getstatus', 'ListController@getStatus');
    Route::get('getnacionalidad', 'ListController@getNacionalidad');
    Route::get('getasignacion', 'ListController@getAsignaciones');
    Route::get('getdeduccion', 'ListController@getDeducciones');
    Route::get('gettipoempleado', 'ListController@getTipoEmpleado');
    Route::get('getareatrabajo', 'ListController@getAreaTrabajo');
    Route::get('getconocimientos', 'ListController@getConocimientos');
    Route::get('getedocivil', 'ListController@getEdoCivil');
    Route::get('gettipoestudio', 'ListController@getTipoEstudio');
    Route::get('gettiporequerimiento', 'ListController@getTipoRequerimiento');

    Route::get('gettipodepartamento', 'ListController@getTipoDepartamento');
    Route::get('gettipodocumento', 'ListController@getTipoDocumento');
    Route::get('gettipocliente', 'ListController@getTipoCliente');
    Route::get('gettipoextension', 'ListController@getTipoExtension');
    Route::get('gettipoprocedencia', 'ListController@getTipoProcedencia');

    Route::get('gettipoturno', 'ListController@getTipoTurno');
    Route::get('gettipoproyecto', 'ListController@getTipoProyecto');
    Route::get('gettiposprint', 'ListController@getTipoSprint');
    Route::get('gettipouser', 'ListController@getTipoUser');
    Route::get('gettipoactividad', 'ListController@getTipoActividad');
    Route::get('getTipoactasignacion', 'ListController@getTipoActasignacion');
    Route::get('getProyectoac/{id_proyecto}', 'ListController@getProyectoac');
    Route::get('getProyectoPe/{id_proyecto}', 'ListController@getProyectoPe');
    Route::get('getProyectoPra/{id_proyecto}', 'ListController@getProyectoPra');
    Route::get('getProyectouser/{id_actividad}', 'ListController@getProyectouser');
    Route::get('getTipoUserdos', 'ListController@getTipoUserdos');
    Route::get('getTipoActividadRealizada/{id_actividad}', 'ListController@getTipoActividadRealizada');
    Route::get('getTipoActividadRealizadaUser/{id_datpers}', 'ListController@getTipoActividadRealizadaUser');

    Route::get('getstatusart', 'ListController@getStatusArt');
    Route::get('getarticulocompu', 'ListController@getArticuloCompu');
    Route::get('getarticulomobi', 'ListController@getArticuloMobi');
    Route::get('getarticuloelec', 'ListController@getArticuloElec');
    Route::get('getdepartamento', 'ListController@getDepartamento');
    Route::get('getclasificacion', 'ListController@getClasificacion');


    //RUTAS DEL USUARIO Y DATOS PERSONALES
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::resource('cars', 'CarsController');
    Route::get('users', 'UserController@getUsers');
    Route::get('user/{id}', 'UserController@getUser');

    //RUTAS DE MENU, DASHBOARD Y HOME
    Route::post('getmenu', 'MenuController@getMenuRoles');

    //RUTA DASHBOARD RECLUTAMIENTO
    Route::get('reclutamiento', 'Reclutamiento\ReclutamientoController@contador');

    //RUTAS PARA EL ASPIRANTE
    Route::post('aspirante', 'Reclutamiento\AspiranteController@aspirante');
    Route::post('aspirante/datosacademicos', 'Reclutamiento\AspiranteController@aspiranteDatosAcademicos');
    Route::get('aspirante/datosacademicos/{id_candidato}', 'Reclutamiento\AspiranteController@datosAcademicos');
    Route::post('aspirante/datoslaborales', 'Reclutamiento\AspiranteController@aspiranteDatosLaborales');
    Route::get('aspirante/datoslaborales/{id_candidato}', 'Reclutamiento\AspiranteController@datosLaborales');
    Route::post('aspirante/habilidades', 'Reclutamiento\AspiranteController@aspiranteHabilidades');
    Route::get('aspirante/habilidades/{id_candidato}', 'Reclutamiento\AspiranteController@habilidades');
    Route::post('aspirante/archivos', 'Reclutamiento\AspiranteController@aspiranteArchivos');
    Route::get('aspirante/archivos/{id_candidato}', 'Reclutamiento\AspiranteController@archivos');

//RUTAS PARA RECLUTAMIENTO Y SELECCIÓN DE PERSONAL   
        Route::group(['prefix' => 'reclutamiento'], function () {            
            Route::get('candidato', 'Reclutamiento\ReclutamientoController@getCandidatos');
            Route::post('candidato','Reclutamiento\ReclutamientoController@buscarCandidatoNombres');
            Route::post('candidato/create','Reclutamiento\ReclutamientoController@createCandidato');
            Route::get('candidato/visualizar/{id_candidato}', 'Reclutamiento\ReclutamientoController@unCandidato');
            Route::post('candidato/visualizar/status', 'Reclutamiento\ReclutamientoController@status');
            Route::get('candidato/visualizar/status/{id_candidato}', 'Reclutamiento\ReclutamientoController@statusCan');
            Route::post('candidato/visualizar/status/delete/{id_candidato}', 'Reclutamiento\ReclutamientoController@deleteStatus');
            Route::post('candidato/visualizar/cita', 'Reclutamiento\ReclutamientoController@citaCandidato');
            Route::get('candidato/visualizar/cita/{id_candidato}', 'Reclutamiento\ReclutamientoController@citaCan');
            Route::post('candidato/visualizar/cita/delete/{id_candidato}', 'Reclutamiento\ReclutamientoController@deleteCita');
            Route::post('candidato/visualizar/observacion', 'Reclutamiento\ReclutamientoController@observacionCandidato');
            Route::get('candidato/visualizar/observacion/{id_candidato}', 'Reclutamiento\ReclutamientoController@obsCan');
            Route::post('candidato/visualizar/solicitud', 'Reclutamiento\ReclutamientoController@solicitudCandidato');
            Route::post('candidato/visualizar/obsanalista', 'Reclutamiento\ReclutamientoController@obsAnalista');
            Route::post('candidato/visualizar/obstecnico', 'Reclutamiento\ReclutamientoController@obsTecnico');
            Route::post('candidato/visualizar/obsgerencia', 'Reclutamiento\ReclutamientoController@obsGerencia');
            Route::get('candidato/visualizar/asignacion/{id_candidato}', 'Reclutamiento\ReclutamientoController@solicitudPorcandidato');
            Route::post('candidato/delete/{id}', 'Reclutamiento\ReclutamientoController@deleteCandidato');

            Route::get('solicitud', 'Reclutamiento\ReclutamientoController@getSolicitud');
            Route::post('solicitud/crear','Reclutamiento\ReclutamientoController@crearSolicitud');
            Route::get('solicitud/visualizar/{id_solicitud}','Reclutamiento\ReclutamientoController@unaSolicitud');
            Route::get('solicitud/visualizar/candidatoporsolicitud/{id_solicitud}', 'Reclutamiento\ReclutamientoController@candidatoPorSolicitud');
            Route::post('solicitud', 'Reclutamiento\ReclutamientoController@buscarSolicitudSolicitante');
            // Route::post('solicitud/cargo', 'Reclutamiento\ReclutamientoController@buscarSolicitudCargo');
            // Route::post('solicitud', 'Reclutamiento\ReclutamientoController@buscarDescripcionTrabajoSolicitud');
            Route::post('solicitud/delete/{id}', 'Reclutamiento\ReclutamientoController@deleteSolicitud');

            Route::get('usuarios', 'Reclutamiento\ReclutamientoController@getUsuarios');
            Route::get('usuarios/mostrar/{id}', 'Reclutamiento\ReclutamientoController@unUsuario');
            Route::post('registrousuarios','UserController@register');
            Route::post('usuarios/delete/{id}', 'Reclutamiento\ReclutamientoController@deleteUsuario');
            Route::post('usuarios/actualizar/{id}', 'Reclutamiento\ReclutamientoController@updateUsuario');


            Route::get('posiblesempleados', 'Reclutamiento\ReclutamientoController@posiblesEmpleados');
            Route::post('posiblesempleados/contrato', 'Reclutamiento\ReclutamientoController@contratoCandidato');
            Route::post('posiblesempleados/rechazocontrato', 'Reclutamiento\ReclutamientoController@rechazoContrato');
            Route::get('posiblesempleados/{id_candidato}', 'Reclutamiento\ReclutamientoController@contratoCan');

            Route::get('recursosinternos', 'Reclutamiento\ReclutamientoController@recursosInternos');
        });
// RUTAS PARA INTRANET:
    Route::group(['prefix' => 'intranet'], function () {

        //  RUTAS CONTROL DE ACCESO
        Route::post('controldeacceso', 'Intranet\AsistenciaController@index');
        Route::post('controldeacceso/store', 'Intranet\AsistenciaController@store');
        Route::post('controldeacceso/update', 'Intranet\AsistenciaController@update');
        Route::post('controldeacceso/permisosalida', 'Intranet\AsistenciaController@permisoSalida');
        Route::post('controldeacceso/permisoentrada', 'Intranet\AsistenciaController@permisoEntrada');
        Route::get('systemDateTime', 'Intranet\DateServiceController@systemDateTime');

        //  RUTAS PUBLICACIONES Y NOTICIAS
        Route::get('publicaciones', 'Intranet\PublicacionesController@index');
        Route::get('noticias', 'Intranet\PublicacionesController@getnoticias');
        Route::post('publicaciones/store', 'Intranet\PublicacionesController@store');

        //  RUTAS GESTION DE ACTIVIDADES
        Route::get('actividades', 'Intranet\ActividadesController@index');
        Route::post('actividades/store', 'Intranet\ActividadesController@store');
        Route::post('actividades/update', 'Intranet\ActividadesController@update');
        Route::post('actividades/delete', 'Intranet\ActividadesController@destroy');
        Route::post('actividades/actividad', 'Intranet\ActividadesController@getActivity');

        //  RUTAS EVENTOS
        Route::get('eventos', 'Intranet\ActividadesController@nextEvent');

        //  RUTAS AUDITORIA DEL CONTROL DE ACCESO
        Route::get('auditoriadeacceso', 'Intranet\AuditoriaAccesoController@index');
        Route::get('auditoriadeacceso/showusers', 'Intranet\AuditoriaAccesoController@showusers');
        Route::post('auditoriadeacceso/show', 'Intranet\AuditoriaAccesoController@show');
        Route::get('auditoriadeacceso/showpersonal/{id_user}', 'Intranet\AuditoriaAccesoController@showpersonal');
        Route::get('auditoriadeacceso/getuser/{id_user}', 'Intranet\AuditoriaAccesoController@getuser');

        //  RUTAS CONTROL DE ACTIVIDADES
        Route::post('controldeactividades/store', 'Intranet\ControlActividadesController@store');
        Route::post('controldeactividades/historial', 'Intranet\ControlActividadesController@index');

        //  RUTAS AUDITORIA DEL CONTROL DE ACTIVIDADES
        Route::get('auditoriadeactividades/actividadespersonales/{id_user}', 'Intranet\AuditoriaActividadesController@reporteactividades');

    });

      //Documento
     Route::group(['prefix' => 'documentos'], function () {
   
     Route::post('documento','Documentos\GuardarController@documento');
     Route::post('cliente','Documentos\GuardarController@cliente');
     Route::post('departamento','Documentos\GuardarController@departamento');
     Route::post('tipo_documento','Documentos\GuardarController@tipo_documento');
     Route::post('procedencia','Documentos\GuardarController@procedencia');
     Route::post('extension','Documentos\GuardarController@extension');
     Route::post('subirArchivo','Documentos\GuardarController@subirArchivo');

     Route::get('download/{file}', 'Documentos\GuardarController@download');

  
     Route::get('getdocumentointerno','Documentos\ObtenerController@getDocumentoInterno');
     Route::post('getdocumentointerno','Documentos\ObtenerController@buscarDocumentoInterno');
     Route::get('getdocumentoexterno','Documentos\ObtenerController@getDocumentoExterno');
     Route::post('getdocumentoexterno','Documentos\ObtenerController@buscarDocumentoExterno');
     Route::put('update/{id_documento}', 'Documentos\ObtenerController@update');

   
      
});

//rutas para proyectoS
        Route::group(['prefix' => 'proyecto'], function () { 
        Route::post('crearturno', 'Proyecto\TurnoController@crearturno');
        Route::PUT('actualizarturno/{id_turno}', 'Proyecto\TurnoController@actualizarturno');
        Route::delete('destroyturno/{id_turno}', 'Proyecto\TurnoController@destroyturno');
        Route::post('crearproyecto', 'Proyecto\ProyectoController@crearproyecto');
        Route::put('actualizarproyecto/{id_proyecto}', 'Proyecto\ProyectoController@actualizarproyecto');
        Route::delete('activarproyecto/{id_proyecto}', 'Proyecto\ProyectoController@activarproyecto');
        Route::get('getProyecto', 'Proyecto\ProyectoController@getProyecto');
        Route::get('getProyectoactivi/{id_proyecto}', 'Proyecto\ProyectoController@getProyectoactivi');
        Route::delete('desactivarproyecto/{id_proyecto}', 'Proyecto\ProyectoController@desactivarproyecto');
        Route::post('registroactividad', 'Proyecto\RegistraractividadController@registroactividad');
        Route::put('actualizaractividad/{id_actividad}', 'Proyecto\RegistraractividadController@actualizaractividad');
        Route::post('asignacion', 'Proyecto\AsignaractividadController@asignacion');
        Route::post('crearfase', 'Proyecto\FasesController@crearfase');
        Route::put('actualizarfase/{id_periodo}', 'Proyecto\FasesController@actualizarfase');      
        Route::post('actperiodo', 'Proyecto\ActperiodoController@actperiodo');
        Route::post('actividadrealizada', 'Proyecto\ActividadrealizadaController@actividadrealizada');
        Route::put('actualizarasignacion/{id_act_user}', 'Proyecto\AsignaractividadController@actualizarasignacion');


       });



//RUTAS PARA INVENTARIO
       Route::group(['prefix' => 'inventario'], function () { 

            // RUTAS PARA EL REGISTRO DE ARTICULO
            Route::post('cargainicial', 'Inventario\InventarioController@cargaInicial');
            Route::post('tiporegister', 'Inventario\InventarioController@tipoRegister');

            // RUTA PARA ELIMINAR UN ARTICULO
            Route::post('borrararticulo', 'Inventario\InventarioController@borrarArticulo');
            
            // RUTAS PARA VER DETALLES DE LOS ACTIVOS DE LA EMPRESA
            Route::get('verarticulo', 'Inventario\InventarioController@getArticulo');
            Route::post('verarticuloclas', 'Inventario\InventarioController@getArticuloClas');
            Route::put('actualizar/articulo/{id_articulo}', 'Inventario\InventarioController@putArticulo');
            Route::put('actualizar/articulo/averiado/{id_articulo}', 'Inventario\InventarioController@putArticuloAveriado');
            Route::get('detallesarticulo/{id_articulo}', 'Inventario\InventarioController@detallesArticulo');
            Route::post('verarticulotipo', 'Inventario\InventarioController@getArticuloTipo');
            Route::post('verarticulotipomarca', 'Inventario\InventarioController@getArticuloTipoMarca');
            Route::post('getarticulocodact', 'Inventario\InventarioController@getArticuloCodAct');

            //RUTA PARA MANTENIMIENTO
            Route::get('verarticulomodif', 'Inventario\InventarioController@getArticulosMant');
            Route::post('enviarmantenimiento', 'Inventario\InventarioController@enviarMantenimiento');
            Route::get('getlistamante', 'Inventario\InventarioController@getListaMante');
            Route::get('getListamantespe', 'Inventario\InventarioController@getListaManteEspe');
            Route::put('reincorporar/articulo/averiado/{id_articulo}', 'Inventario\InventarioController@reincorporarArticulo');
            Route::post('getarticulocodmant', 'Inventario\InventarioController@getArticuloCodMant');

            
            //RUTA PARA EL HISTORIAL DEL INVENTARIO
            Route::post('getarticuloclashist', 'Inventario\InventarioController@getArticuloClasHist');
            Route::get('detallesarticulohistorial/{id_articulo}', 'Inventario\InventarioController@detallesArticuloHistorial');
            Route::post('getarticulotipohist', 'Inventario\InventarioController@getArticuloTipoHist');
            Route::post('getaccionhist', 'Inventario\InventarioController@getAccionHist');
            Route::get('gethistorial', 'Inventario\InventarioController@getHistorial');
            Route::post('getarticulocodhist', 'Inventario\InventarioController@getArticuloCodhist');
            //Route::post('usuariohist', 'Inventario\InventarioController@usuarioHist');

            //RUTAS PARA LAS ASIGNACIONES
            Route::get('traerpersona', 'Inventario\AsignacionController@getPersonal');
            Route::post('personal', 'Inventario\AsignacionController@comparaArticulo');
            Route::post('guardarasignacion','Inventario\AsignacionController@guardarAsignacion');
            Route::post('guardarasignaciondep','Inventario\AsignacionController@guardarAsignacionDep');
            Route::post('asignacionesoneperson', 'Inventario\AsignacionController@asignacionesOnePerson');
            Route::post('asignacionesonedepa', 'Inventario\AsignacionController@asignacionesOneDepa');
            Route::post('borrarasignacion', 'Inventario\AsignacionController@borrarAsignacion');
            Route::post('borrarasignaciondep', 'Inventario\AsignacionController@borrarAsignacionDep');
            Route::get('getmarcacomputacion', 'Inventario\AsignacionController@getMarcaComputacion');
            Route::get('getmarcamobiliario', 'Inventario\AsignacionController@getMarcaMobiliario');
            Route::get('getarticulouso', 'Inventario\AsignacionController@getArticuloUso');
            Route::get('getarticulodep', 'Inventario\AsignacionController@getArticuloDep');
            Route::get('buscarpersonal', 'Inventario\AsignacionController@BuscarPersonal');


            

        });



    //RUTAS ADMINISTRACION PRUEBA QUERY BUILDER
    Route::post('cargo/crear', 'Administracion\CargosController@crearCargos');
    Route::post('rol/crear', 'Administracion\RolesController@crearRoles');
    Route::post('profesion/crear', 'Administracion\ProfesionController@crearProfesion');
    Route::post('asignacion/crear', 'Administracion\AsignacionesController@crearAsignaciones');
    Route::post('deduccion/crear', 'Administracion\DeduccionesController@crearDeducciones');
    Route::post('tipoempleado/crear', 'Administracion\TipoEmpleadoController@crearTipoEmpleado');
    Route::post('areatrabajo/crear', 'Administracion\AreaTrabajoController@crearAreasTrabajo');
    Route::post('conocimientos/crear', 'Administracion\ConocimientosController@crearConocimientos');
    Route::post('edocivil/crear', 'Administracion\EdoCivilController@crearEdoCivil');
    Route::post('genero/crear', 'Administracion\GeneroController@crearGenero');
    Route::post('idioma/crear', 'Administracion\IdiomasController@crearIdioma');
    Route::post('modulo/crear', 'Administracion\ModulosController@crearModulos');
    Route::post('nacionalidad/crear', 'Administracion\NacionalidadController@crearNacionalidad');
    Route::post('nivel/crear', 'Administracion\NivelController@crearNivel');
    Route::post('pais/crear', 'Administracion\PaisController@crearPais');
    Route::post('estatus/crear', 'Administracion\EstatusController@crearEstatus');
    Route::post('tipoestudio/crear', 'Administracion\TipoEstudioController@crearTipoEstudio');
    Route::post('tiporequerimiento/crear', 'Administracion\TipoRequerimientoController@crearTipoRequerimiento');

    Route::put('cargo/actualizar/{id}', 'Administracion\CargosController@actualizarCargos');
    Route::put('rol/actualizar/{id}', 'Administracion\RolesController@actualizarRoles');
    Route::put('profesion/actualizar/{id}', 'Administracion\ProfesionController@actualizarProfesion');
    Route::put('asignacion/actualizar/{id}', 'Administracion\AsignacionesController@actualizarAsignaciones');
    Route::put('deduccion/actualizar/{id}', 'Administracion\DeduccionesController@actualizarDeducciones');
    Route::put('tipoempleado/actualizar/{id}', 'Administracion\TipoEmpleadoController@actualizarTipoEmpleado');
    Route::put('areatrabajo/actualizar/{id}', 'Administracion\AreaTrabajoController@actualizarAreasTrabajo');
    Route::put('conocimientos/actualizar/{id}', 'Administracion\ConocimientosController@actualizarConocimientos');
    Route::put('edocivil/actualizar/{id}', 'Administracion\EdoCivilController@actualizarEdoCivil');
    Route::put('genero/actualizar/{id}', 'Administracion\GeneroController@actualizarGenero');
    Route::put('idioma/actualizar/{id}', 'Administracion\IdiomasController@actualizarIdioma');
    Route::put('modulo/actualizar/{id}', 'Administracion\ModulosController@actualizarModulo');
    Route::put('nacionalidad/actualizar/{id}', 'Administracion\NacionalidadController@actualizarNacionalidad');
    Route::put('nivel/actualizar/{id}', 'Administracion\NivelController@actualizarNivel');
    Route::put('pais/actualizar/{id}', 'Administracion\PaisController@actualizarPais');
    Route::put('estatus/actualizar/{id}', 'Administracion\EstatusController@actualizarEstatus');
    Route::put('tipoestudio/actualizar/{id}', 'Administracion\TipoEstudioController@actualizarTipoEstudio');
    Route::put('tiporequerimiento/actualizar/{id}', 'Administracion\TipoRequerimientoController@actualizarTipoRequerimiento');

    Route::delete('cargo/activar/{id}', 'Administracion\CargosController@activarCargos');
    Route::delete('cargo/desactivar/{id}', 'Administracion\CargosController@desactivarCargos');
    Route::delete('rol/activar/{id}', 'Administracion\RolesController@activarRoles');
    Route::delete('rol/desactivar/{id}', 'Administracion\RolesController@desactivarRoles');
    Route::delete('profesion/activar/{id}', 'Administracion\ProfesionController@activarProfesion');
    Route::delete('profesion/desactivar/{id}', 'Administracion\ProfesionController@desactivarProfesion');
    Route::delete('asignacion/activar/{id}', 'Administracion\AsignacionesController@activarAsignaciones');
    Route::delete('asignacion/desactivar/{id}', 'Administracion\AsignacionesController@desactivarAsignaciones');
    Route::delete('deduccion/activar/{id}', 'Administracion\DeduccionesController@activarDeducciones');
    Route::delete('deduccion/desactivar/{id}', 'Administracion\DeduccionesController@desactivarDeducciones');
    Route::delete('tipoempleado/activar/{id}', 'Administracion\TipoEmpleadoController@activarTipoEmpleado');
    Route::delete('tipoempleado/desactivar/{id}', 'Administracion\TipoEmpleadoController@desactivarTipoEmpleado');
    Route::delete('areatrabajo/activar/{id}', 'Administracion\AreaTrabajoController@activarAreasTrabajo');
    Route::delete('areatrabajo/desactivar/{id}', 'Administracion\AreaTrabajoController@desactivarAreasTrabajo');
    Route::delete('conocimientos/activar/{id}', 'Administracion\ConocimientosController@activarConocimientos');
    Route::delete('conocimientos/desactivar/{id}', 'Administracion\ConocimientosController@desactivarConocimientos');
    Route::delete('edocivil/activar/{id}', 'Administracion\EdoCivilController@activarEdoCivil');
    Route::delete('edocivil/desactivar/{id}', 'Administracion\EdoCivilController@desactivarEdoCivil');
    Route::delete('genero/activar/{id}', 'Administracion\GeneroController@activarGenero');
    Route::delete('genero/desactivar/{id}', 'Administracion\GeneroController@desactivarGenero');
    Route::delete('idioma/activar/{id}', 'Administracion\IdiomasController@activarIdioma');
    Route::delete('idioma/desactivar/{id}', 'Administracion\IdiomasController@desactivarIdioma');
    Route::delete('modulo/activar/{id}', 'Administracion\ModulosController@activarModulo');
    Route::delete('modulo/desactivar/{id}', 'Administracion\ModulosController@desactivarModulo');
    Route::delete('nacionalidad/activar/{id}', 'Administracion\NacionalidadController@activarNacionalidad');
    Route::delete('nacionalidad/desactivar/{id}', 'Administracion\NacionalidadController@desactivarNacionalidad');
    Route::delete('nivel/activar/{id}', 'Administracion\NivelController@activarNivel');
    Route::delete('nivel/desactivar/{id}', 'Administracion\NivelController@desactivarNivel');
    Route::delete('pais/activar/{id}', 'Administracion\PaisController@activarPais');
    Route::delete('pais/desactivar/{id}', 'Administracion\PaisController@desactivarPais');
    Route::delete('estatus/activar/{id}', 'Administracion\EstatusController@activarEstatus');
    Route::delete('estatus/desactivar/{id}', 'Administracion\EstatusController@desactivarEstatus');
    Route::delete('tipoestudio/activar/{id}', 'Administracion\TipoEstudioController@activarTipoEstudio');
    Route::delete('tipoestudio/desactivar/{id}', 'Administracion\TipoEstudioController@desactivarTipoEstudio');
    Route::delete('tiporequerimiento/activar/{id}', 'Administracion\TipoRequerimientoController@activarTipoRequerimiento');
    Route::delete('tiporequerimiento/desactivar/{id}', 'Administracion\TipoRequerimientoController@desactivarTipoRequerimiento');

});
