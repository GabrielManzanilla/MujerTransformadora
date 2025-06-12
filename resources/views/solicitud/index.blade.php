
<x-app-layout>
	<div>
		<x-table 	:title="'Solicitudes'"
							:headers="['Status', 'Actividad Economica', 'Regimen', 'Empleados']"
							:items="['str_status','str_actividad_economica', 'str_regimen', 'int_numero_empleados', 'str_nombre_razon_social', 'str_rfc', 'str_curp', 'str_domicilio_fiscal']"
							:data="$datosFiscales"
							:route="'solicitud.show'"
							:param="'pk_dato_fiscal'"
							:actions="true">

		</x-table>
	</div>
</x-app-layout>