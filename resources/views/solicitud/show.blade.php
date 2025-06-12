<x-app-layout>
	<div class=" h-full w-full overflow-auto p-2 md:p-5">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<div class="flex flex-row gap-2 items-center mb-4">
						<x-status status="{{ $datoFiscal->str_status }}" />
						<h2 class="font-semibold text-xl text-gray-800 leading-tight ">
							{{ "Solicitud para \"{$datoFiscal->str_nombre_comercial}\"" }}
						</h2>
					</div>
					<div class="flex flex-col gap-4">
						<div class="bg-gray-100 px-8 py-6 rounded-lg shadow flex-1">
							<h3 class="font-bold text-lg mb-2 uppercase">Información Fiscal</h3>
							<p><strong>Regimen: </strong>{{ $datoFiscal->str_regimen }}</p>
							<p><strong>Actividad Economica: </strong>{{ $datoFiscal->str_actividad_economica }}</p>
							<p><strong>Razon Social: </strong>{{ $datoFiscal->str_razon_social }}</p>
							<p><strong>Cantidad de Empleados: </strong>{{ $datoFiscal->int_numero_empleados }}</p>
						</div>
						<div class="bg-gray-100 px-8 py-6 rounded-lg shadow flex-1 ">
							<h3 class="font-bold text-lg mb-2 uppercase">Credenciales</h3>
							<div class="grid grid-cols-3">
								<p><strong>RFC: </strong>{{ $datoFiscal->str_clave_sat }}</p>
								<p><strong>IMSS: </strong>{{ $datoFiscal->str_clave_imss }}</p>
								<p><strong>IMPI: </strong>{{ $datoFiscal->str_clave_impi }}</p>
								<p><strong>AFFY: </strong>{{ $datoFiscal->str_clave_affy }}</p>
								<p><strong>CIF: </strong>{{ $datoFiscal->str_clave_cif }}</p>
							</div>
						</div>
						<div class="bg-gray-100 p-4 rounded-lg shadow flex-1">
							<x-table title="Domicilios Asociados" :data="$datoFiscal->domicilios" :headers="['Direccion', 'Estado', 'Municipio', 'Localidad']"
								:items="['str_direccion', 'str_estado', 'str_municipio', 'str_localidad']" />
						</div>

						<div class="bg-gray-100 p-4 rounded-lg shadow flex-1">
							<x-table title="Productos" :data="$datoFiscal->productos" :headers="['Nombre', 'Descripcion', 'Prod. Mensual', 'Ventas Mensuales', 'Ventas Anuales']"
								:items="['str_nombre', 'str_descripcion', 'int_produccion_mensual', 'double_ventas_mensuales', 'double_ventas_anuales']" />

						</div>

						<div class="bg-gray-100 p-4 rounded-lg shadow flex-1">
							<x-table title="Redes Sociales" :data="$datoFiscal->redesSociales" :headers="['Red Social', 'Perfil', 'URL de Perfil']"
								:items="['str_nombre_red_social', 'str_perfil_red_social', 'str_url_red_social']" />
						</div>


						<!-- Añadir seccion de los documentos -->
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>