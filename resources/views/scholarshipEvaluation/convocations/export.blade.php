<table>
    <tbody>
        <tr>
            <td>PERIODO</td>
            <td>NOMBRE</td>
            <td>CORREO CONTACTO</td>
            <td>FECHA INICIO</td>
            <td>FECHA FIN</td>
            <td>BECA %</td>
            <td>COMENTARIOS</td>
        </tr>
        <tr>
            @foreach ($conv as $item)
            <td>{{$item['conv_period']}}</td>
            <td>{{$item['conv_name']}}</td>
            <td>{{base64_decode($item['conv_email'])}}</td>
            <td>{{$item['conv_start_date']}}</td>
            <td>{{$item['conv_end_date']}}</td>
            <td>{{$item['conv_porcentage']}}</td>
            <td>{{$item['conv_comments']}}</td>
            @endforeach
            
        </tr>
        <tr></tr>
        <tr>
            <td>ID ALUMNO</td>
            <td>NOMBRE</td>
            <td>CARRERA</td>
            <td>CORREO</td>
            <td>CORREO ALT</td>
            <td>TIPO DE BECA</td>
            <td>% BECA</td>
            <td></td>
            <td></td>
            <td>ID COORDINADOR</td>
            <td>NOMBRE</td>
            <td>ÁREA</td>
            <td>SUB ÁREA</td>
            <td>CORREO</td>
            <td>CORREO ALT</td>
        </tr>

        @foreach ($asignados as $value)

        <tr>
            <td>{{$value ['us_banner_id']}}</td>
            <td>{{$value ['name']}}</td>
            <td>{{$value ['ar_uID']}}</td>
            <td>{{$value ['email']}}</td>
            <td>{{$value ['emailPersonal']}}</td>
            <td>{{$value ['sch_type']}}</td>
            <td>{{$value ['sch_porcentage']}}</td>
            <td><td>
            <td>{{$value ['us_banner_id1']}}</td> 
            <td>{{$value ['name1']}}</td> 
            <td>{{$value ['ar_uID1']}}</td> 
            <td>{{$value ['sub_uID1']}}</td> 
            <td>{{$value ['email1']}}</td> 
            <td>{{$value ['emailPersonal1']}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
