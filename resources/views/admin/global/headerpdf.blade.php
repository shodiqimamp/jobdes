<table style="width:585px">
    <tr>
        <td>{{date('d/m/Y')}}</td>
        @php 
        $image = base64_encode(file_get_contents('../public/img/logo.png'));
        @endphp
        <td style="vertical-align:top; text-align:right"><img style="width:auto; height:45px" src="@={{$image}}"></td>
    </tr>
</table>
    
    
