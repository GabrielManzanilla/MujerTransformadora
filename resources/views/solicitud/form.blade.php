<x-app-layout>
	<div class="w-full h-full p-1">
		<div class="w-full h-full rounded-lg bg-white shadow-md p-2 m-0">
			<x-form 
				action="{{ isset($datoFiscal) 
					? route('solicitud.update', $datoFiscal->pk_dato_fiscal) 
					: route('solicitud.store') }}"
				method="{{ isset($datoFiscal) ? 'PUT' : 'POST' }}"
				formTitle="{{ isset($datoFiscal) ? 'Editar Solicitud' : 'Formulario de Solicitud' }}">

					<x-fieldset label="Datos Fiscales" step="1">
						<x-input-solicitud name="actividad_economica" label="Actividad Economica" type="text"
							value="{{ old('str_activdad_economica', $datoFiscal->str_actividad_economica ?? '') }}" />
						<x-input-solicitud name="regimen" label="Regimen" type="text"
							value="{{ old('str_regimen', $datoFiscal->str_regimen ?? '') }}" />
						<x-input-solicitud name="nombre_comercial" label="Nombre Comercial" type="text"
							value="{{ old('str_nombre_comercial', $datoFiscal->str_nombre_comercial ?? '') }}" />
						<x-input-solicitud name="numero_empleados" label="Numero de Empleados" type="number"
							value="{{ old('int_numero_empleados', $datoFiscal->int_numero_empleados ?? '') }}" />
						<x-input-solicitud name="razon_social" label="Razon Social" type="text"
							value="{{ old('str_razon_social', $datoFiscal->str_razon_social ?? '') }}" />
						<x-input-solicitud name="clave_imss" label="Clave IMSS" type="text"
							value="{{ old('str_clave_imss', $datoFiscal->str_clave_imss ?? '') }}" />
						<x-input-solicitud name="clave_impi" label="Clave IMPI" type="text"
							value="{{ old('str_clave_impi', $datoFiscal->str_clave_impi ?? '') }}" />
						<x-input-solicitud name="clave_affy" label="Clave AFFY" type="text"
							value="{{ old('str_clave_affy', $datoFiscal->str_clave_affy ?? '') }}" />
						<x-input-solicitud name="clave_sat" label="Clave SAT" type="text"
							value="{{ old('str_clave_sat', $datoFiscal->str_clave_sat ?? '') }}" />
						<x-input-solicitud name="clave_cif" label="Clave CIF" type="text"
							value="{{ old('str_clave_cif', $datoFiscal->str_clave_cif ?? '') }}" />
					</x-fieldset>

					<x-fieldset label="Domicilios" step="2">
						<x-slot name="dinamic_input">
							<x-dinamic-input :headers="['Direccion', 'Estado', 'Municipio', 'Localidad']" id_button="add_domicilio"
								id_message="message_domicilios_table_empty" id_table="domicilios_table" id_json="domicilios_json"
								value="{!! old('domicilios', $domicilios ?? '') !!}">
								<x-input-solicitud id="direccion" label="Direccion" type="text" class="lg:col-span-3" />
								<x-input-solicitud id="estado_domiclio" label="Estado" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
								<x-input-solicitud id="municipio_domicilio" label="Municipio" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
								<x-input-solicitud id="localidad_domicilio" label="Localidad" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
							</x-dinamic-input>
						</x-slot>
					</x-fieldset>

					<x-fieldset label="Productos" step="3">
						<x-slot name="dinamic_input">
							<x-dinamic-input :headers="['Nombre Producto', 'Descripcion', 'Produccion Mensual', 'Ventas Mensuales', 'Ventas Anuales']" id_button="add_producto" id_message="message_productos_table_empty"
								id_table="productos_table" id_json="productos_json">
								<x-input-solicitud id="nombre_producto" label="Nombre Producto" type="text" />
								<x-input-solicitud id="descripcion_producto" label="Descripcion" type="text" class="lg:col-span-2" />
								<x-input-solicitud id="produccion_mensual" label="Produccion Mensual" type="number" />
								<x-input-solicitud id="ventas_mensuales" label="Ventas Mensuales" type="number" />
								<x-input-solicitud id="ventas_anuales" label="Ventas Anuales" type="number" />
							</x-dinamic-input>
						</x-slot>
					</x-fieldset>

					<x-fieldset label="Redes Sociales" step="4">
						<x-slot name="dinamic_input">
							<x-dinamic-input :headers="['Red Social', 'Nombre', 'Enlace']" id_button="add_red_social"
								id_message="message_redes_sociales_table_empty" id_table="redes_sociales_table"
								id_json="redes_sociales_json">
								<x-input-solicitud id="red_social" label="Red Social" type="select" :options="['Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Instagram' => 'Instagram']" />
								<x-input-solicitud id="nombre_red_social" label="Nombre" type="text" />
								<x-input-solicitud id="enlace_red_social" label="Enlace" type="text" />
							</x-dinamic-input>
						</x-slot>
					</x-fieldset>

					<x-fieldset label="Documentos" step="5">
						<div>
							<x-input-label for="Constancia_imss" value="Constancia IMSS" class="pl-4" />
							<x-input-file id="constancia_imss" />
						</div>
						<div>
							<x-input-label for="constancia_impi" value="Constancia IMPI" class="pl-4" />
							<x-input-file id="constancia_impi" />
						</div>
						<div>
							<x-input-label for="constancia_affy" value="Constancia AFFY" class="pl-4" />
							<x-input-file id="constancia_affy" />
						</div>
						<div>
							<x-input-label for="constancia_sat" value="Constancia SAT" class="pl-4" />
							<x-input-file id="constancia_sat" />
						</div>
						<div>
							<x-input-label for="constancia_cif" value="Constancia CIF" class="pl-4" />
							<x-input-file id="constancia_cif" />
						</div>
					</x-fieldset>

				</x-form>
		</div>
	</div>
</x-app-layout>