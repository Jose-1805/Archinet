<?php
    return [
        //NO CAMBIAR
        'funciones'=>[
            'crear'=>1,
            'editar'=>2,
            'ver'=>3,
            'eliminar'=>4,
            'uploads'=>5,
            'historial'=>6,
            'validar_documentos'=>7,
        ],

        //URL DE DIRECTORIOS DE STORAGE
        'storage_img_perfil_usuario'=>'usuarios/imagenes/perfil/',
        'colores'=>[
            'naranja'=>'rgb(252,115,35)',
            'verde'=>'rgb(8,150,155)',//'rgb(35,130,118)',
            'verde_complementario'=>'rgb(89,181,72)',
            'principal'=>'rgb(8,150,155)'
        ],
        'habilitar_roles_funcionarios'=>true,

        //almacena las validaciones por cada tipo documental
        //cada key se toma del valor que almacena el campo 'carpeta' en la tabla de tipos documentales
        'validaciones_tipos_documentales'=>[
            'acta_posesion_nombramiento' => [
                'numero_acta'=>'required|min:2',
                'fecha_nombramiento'=>'required|date|before_or_equal:'.date('Y-m-d'),
                'tipo_nombramiento'=>'required_without:tipo_novedad',
                'tipo_novedad'=>'required_without:tipo_nombramiento',
                'cargo'=>'required|in:Auxiliar,Oficinista,Secretaria,Técnico,Profesional,Subdirector de centro,Asesor,Director regional B,Instructor,Aseador(a),Conductor,Trabajador de campo,Oficial mantto general',
                'grado'=>'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
                'salario'=>'required|digits_between:5,8',
                'dependencia'=>'required|in:Despacho de dirección,Centro agropecuario,Centro de comercio y servicios,Centro de teleinformatica y producción industrial'
            ],

            'certificaciones_laborales' => [
                'tipo'=>'required|in:Interna,Externa',
                'fecha_vinculacion'=>'required|date|before_or_equal:'.date('Y-m-d'),
                'fecha_terminacion'=>'required|date|before_or_equal:'.date('Y-m-d'),
                'asignacion_mensual'=>'required_if:tipo,Interna|nullable|digits_between:6,8',
                //INTERNA
                'regional'=>'required_if:tipo,Interna|nullable|alpha|max:45|min:4',
                'tipo_nombramiento'=>'required_if:tipo,Interna|nullable|in:Periodo de prueba,Carrera administrativa,Provisional,Ordinario,Trabajador oficial,Ascenso,Incorporación',
                'cargo'=>'required_if:tipo,Interna|nullable|in:Auxiliar,Oficinista,Secretaria,Técnico,Profesional,Subdirector de centro,Asesor,Director regional B,Instructor,Aseador(a),Conductor,Trabajador de campo,Oficial mantto general',
                'grado'=>'required_if:tipo,Interna|nullable|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',

                //
                'empresa'=>'required_if:tipo,Externa|nullable|max:60|min:4',
                'cargo_externa'=>'required_if:tipo,Externa|min:4|max:150',
            ],

            'certificados_estudio_diplomas' => [
                'tipo'=>'required|in:Formal,No Formal',
                'nivel_estudio'=>'required_if:tipo,Formal|nullable',
                'nivel_estudio_no_formal'=>'required_if:tipo,No Formal|nullable',
                'tipo_duracion'=>'required',
                'duracion'=>'required|digits_between:1,3|numeric',
                'institucion'=>'required',
                'nombre_curso'=>'required_if:tipo,No Formal|nullable|max:250|min:3',
                'titulo_obtenido'=>'required_if:tipo,Formal|nullable|max:250|min:3',
                'graduado'=>'required|in:si,no',
                'fecha_inicio'=>'nullable|date|before_or_equal:'.date('Y-m-d'),
                'fecha_fin'=>'required_if:graduado,si|nullable|date|before_or_equal:'.date('Y-m-d'),
            ],

            'resoluciones_vacaciones' => [
                'no_resolucion'=>'required|digits_between:2,4',
                'tipo'=>'required|in:Individuales,Colectivas',
                'no_dias_vacacionar'=>'required|digits_between:1,3',
                'fecha_inicio'=>'required|date|before_or_equal:'.date('Y-m-d'),
                'fecha_fin'=>'required|date|before_or_equal:'.date('Y-m-d'),
            ],

            'resoluciones_vacaciones_interrumpidas' => [
                'no_resolucion'=>'required|digits_between:2,4',
                'no_resolucion_anterior'=>'required|digits_between:2,4',
                'no_dias_no_vacacionados'=>'required|digits_between:1,3'
            ],

            'evaluacion_desempenio' => [
                'fecha_inicio'=>'required|date|before_or_equal:'.date('Y-m-d'),
                'fecha_fin'=>'required|date|before_or_equal:'.date('Y-m-d'),
            ]
        ],



        //almacena las validaciones por cada tipo documental
        //cada key se toma del valor que almacena el campo 'carpeta' en la tabla de tipos documentales
        'mensajes_validaciones_tipos_documentales'=>[
            'acta_posesion_nombramiento' => [
                'numero_acta.required'=>'Debe escribir un número de acta',
                'numero_acta.min'=>'El campo debe contener al menos 2 caracteres',
                'fecha_nombramiento.required'=>'Debe seleccionar una fecha de nombramiento',
                'fecha_nombramiento.before_or_equal'=>'La fecha seleccionada no puede ser posterior a la actual',
                'tipo_nombramiento.required_without'=>'Debe seleccionar un tipo de nombramiento o un tipo de novedad',
                'tipo_novedad.required_without'=>'Debe seleccionar un tipo de nombramiento o un tipo de novedad',
                'cargo.required'=>'Debe seleccionar un cargo',
                'cargo.in'=>'La información enviada es incorrecta',
                'grado.required'=>'Debe seleccionar un grado',
                'grado.in'=>'La información enviada es incorrecta',
                'salario.required'=>'Debe escribir el salario',
                'salario.digits_between'=>'El campo debe contener al menos 5 caracteres',
                'dependencia.required'=>'Debe seleccionar una dependencia',
                'dependencia.in'=>'La información enviada es incorrecta',
            ],

            'certificaciones_laborales' => [
                'tipo.required'=>'El campo tipo  debe ser igual a uno de estos valores: Externa, Interna.',
                'tipo.in'=>'El campo tipo  debe ser igual a uno de estos valores: Externa, Interna.',
                'fecha_vinculacion.required'=>'Debe seleccionar una fecha de vinculación',
                'fecha_vinculacion.before_or_equals'=>'No es posible seleccionar una fecha posterior a la actual',
                'fecha_terminacion.required'=>'Debe seleccionar una fecha de terminacón',
                'fecha_terminacion.before_or_equals'=>'No es posible seleccionar una fecha posterior a la actual',
                'asignacion_mensual.required_if'=>'Debe escribir una asignación mensual',
                'asignacion_mensual.digits_between'=>'El campo debe contener al menos 6 caracteres',

                //INTERNA
                'regional.required_if'=>'Debe escribir una regional',
                'regional.alpha'=>'Sólo se permiten caracteres alfabéticos (a-z/A-Z)',
                'regional.max'=>'Este campo no permite más de 45 caracteres',
                'regional.min'=>'El campo debe contener al menos 4 caracteres',

                'tipo_nombramiento.required_if' => 'Debe seleccionar un tipo de nombramiento',
                'cargo.required_if' => 'Debe seleccionar un cargo',
                'grado.required_if'=>'Debe seleccionar un grado',

                //EXTERNA
                'empresa.required_if'=>'Debe escribir una empresa',
                'empresa.max'=>'Este campo no permite más de 60 caracteres',
                'empresa.min'=>'El campo debe contener al menos 4 caracteres',
                'cargo_externa.required_if'=>'Debe escribir un cargo',
                'cargo_externa.max'=>'Este campo no permite más de 150 caracteres',
            ],

            'certificados_estudio_diplomas' => [
                'tipo.required'=>'El campo tipo  debe ser igual a uno de estos valores: Formal, No Formal',
                'tipo.in'=>'El campo tipo  debe ser igual a uno de estos valores: Formal, No Formal',

                'nivel_estudio.required_if' => 'Debe seleccionar un nivel de estudio',

                'nivel_estudio_no_formal.required_if' => 'Debe seleccionar un nivel de estudio',

                'tipo_duracion.required' => 'Debe seleccionar un tipo de duración',

                'duracion.required'=>'Debe escribir una duración',
                'duracion.digits_between'=>'Este campo no permite más de 3 caracteres',
                'duracion.numeric'=>'Sólo se permiten caracteres numéricos (0-9)',

                'institucion.required'=>'Debe seleccionar una institución',
                'institucion.max'=>'Este campo no permite más de 60 caracteres',
                'institucion.min'=>'El campo debe contener al menos 4 caracteres',

                'nombre_curso.required_if'=>'Debe escribir un nombre de curso',
                'nombre_curso.max'=>'Este campo no permite más de 250 caracteres',
                'nombre_curso.min'=>'El campo debe contener al menos 3 caracteres',

                'titulo_obtenido.required_if'=>'Debe escribir un título obtenido',
                'titulo_obtenido.max'=>'Este campo no permite más de 250 caracteres',
                'titulo_obtenido.min'=>'El campo debe contener al menos 3 caracteres',

                'graduado.required' => 'Debe seleccionar si es o no es graduado',
                'graduado.in' => 'Debe seleccionar si es o no es graduado',

                'fecha_inicio.required_if'=>'Debe seleccionar una fecha',
                'fecha_inicio.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),

                'fecha_fin.required_if'=>'Debe seleccionar una fecha',
                'fecha_fin.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),
            ],

            'resoluciones_vacaciones' => [
                'no_resolucion.required'=>'Debe escribir un número de resolución',
                'no_resolucion.digits_between'=>'El campo debe contener al menos 2 caracteres',

                'tipo.required'=>'El campo tipo  debe ser igual a uno de estos valores: Individuales, Colectivas',
                'tipo.in'=>'El campo tipo  debe ser igual a uno de estos valores: Individuales, Colectivas',

                'no_dias_vacacionar.required'=>'Debe escribir el número de días a vacacionar',
                'no_dias_vacacionar.digits_between'=>'El campo debe contener al menos 1 caracter',

                'fecha_inicio.required'=>'Debe seleccionar una fecha',
                'fecha_inicio.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),

                'fecha_fin.required'=>'Debe seleccionar una fecha',
                'fecha_fin.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),
            ],

            'resoluciones_vacaciones_interrumpidas' => [
                'no_resolucion.required'=>'Debe escribir un número de resolución',
                'no_resolucion.digits_between'=>'El campo debe contener al menos 2 caracteres',

                'no_resolucion_anterior.required'=>'Debe escribir un número de resolución anterior',
                'no_resolucion_anterior.digits_between'=>'El campo debe contener al menos 2 caracteres',

                'no_dias_no_vacacionados.required'=>'Debe escribir el número de días no vacacionados',
                'no_dias_no_vacacionados.digits_between'=>'El campo debe contener al menos 1 caracter',
            ],

            'evaluacion_desempenio' => [
                'fecha_inicio.required'=>'Debe seleccionar una fecha',
                'fecha_inicio.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),

                'fecha_fin.required'=>'Debe seleccionar una fecha',
                'fecha_fin.before_or_equal'=>'La fecha seleccionada debe ser anterior o igual a '.date('Y-m-d'),
            ]

        ]
    ];
?>
<?php
date_default_timezone_set(' America/Bogota');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'La zona horaria del script difiere de la zona horaria de la configuracion ini.';
} else {
    echo 'La zona horaria del script y la zona horaria de la configuración ini coinciden.';
}
?>
