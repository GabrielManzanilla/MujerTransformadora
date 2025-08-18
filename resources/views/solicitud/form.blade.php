<x-app-layout>
	<div class="w-full h-full p-1">
		<div class="w-full h-full rounded-lg bg-white shadow-md p-2 m-0">
			<x-form action="{{ isset($datoFiscal)
	? route('solicitud.update', $datoFiscal->pk_dato_fiscal)
	: route('solicitud.store') }}" method="{{ isset($datoFiscal) ? 'PUT' : 'POST' }}"
				formTitle="{{ isset($datoFiscal) ? 'Editar Solicitud' : 'Formulario de Solicitud' }}">

				@if(auth()->user()->role === 'admin')

					<x-fieldset label="Datos Personales" step="1">
						<x-input-solicitud name="nombre" label="Nombre" type="text"
							value="{{ old('str_nombre', $datoPersonal->str_nombre ?? '') }}" />
						<x-input-solicitud name="apellido_paterno" label="Apellido Paterno" type="text"
							value="{{ old('str_apellido_paterno', $datoPersonal->str_apellido_paterno ?? '') }}" />
						<x-input-solicitud name="apellido_materno" label="Apellido Materno" type="text"
							value="{{ old('str_apellido_materno', $datoPersonal->str_apellido_materno ?? '') }}" />
						<x-input-solicitud name="fecha_nacimiento" label="Fecha de Nacimiento" type="date"
							value="{{ old('dt_fecha_nacimiento', $datoPersonal->dt_fecha_nacimiento ?? '') }}" />
						<x-input-solicitud name="curp" label="CURP" type="text"
							value="{{ old('str_curp', $datoPersonal->str_curp ?? '') }}" />
						<x-input-solicitud name="municipio_nacimiento" label="Municipio de Nacimiento" type="text"
							value="{{ old('str_municipio_nacimiento', $datoPersonal->str_municipio_nacimiento ?? '') }}" />
						<x-input-solicitud name="estado_nacimiento" label="Estado de Nacimiento" type="text"
							value="{{ old('str_estado_nacimiento', $datoPersonal->str_estado_nacimiento ?? '') }}" />
						<div>
							<label>Sexo: </label>
							<select id="sexo" name="sexo"
								class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
								<option value="Masculino" {{ old('str_sexo', $perfil->str_sexo ?? '') == 'Masculino' ? 'selected' : '' }}>
									Masculino</option>
								<option value="Femenino" {{ old('str_sexo', $perfil->str_sexo ?? '') == 'Femenino' ? 'selected' : '' }}>
									Femenino</option>
							</select>
						</div>
						<div class="mt-4">
							<input type="hidden" name="es_mayahablante" value="0">
							<div class="flex gap-1">
								<input id="es_mayahablante" type="checkbox" name="es_mayahablante" value="1" {{ old('bool_es_mayahablante', $perfil->bool_es_mayahablante ?? '') == 1 ? 'checked' : '' }}
									class="rounded border-gray-300 text-secondary shadow-sm focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
								<x-input-label for="es_mayahablante" :value="__('¿Es mayahablante?')" />
							</div>
							<x-input-error :messages="$errors->get('es_mayahablante')" class="mt-2" />
						</div>
						<div class="mt-4">
							<x-input-label for="telefono" :value="__('Teléfono')" />
							<x-text-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('str_telefono', $perfil->str_telefono ?? '')" required autocomplete="tel" />
							<x-input-error :messages="$errors->get('telefono')" class="mt-2" />
						</div>
						<div class="mt-4 col-span-2">
							<x-input-label for="foto_perfil" :value="__('Foto de Perfil')" />
							<x-input-file id="foto_perfil" accept="image/*" />
							<x-input-error :messages="$errors->get('foto_perfil')" class="mt-2" />
						</div>

						<!-- INE -->
						<div class="mt-4 col-span-2">
							<x-input-label for="ine" :value="__('INE')" />
							<x-input-file id="ine" accept="pdf/*" />
							<x-input-error :messages="$errors->get('ine')" class="mt-2" />
							<x-input-label :value="__('Ingrese una imagen (png, jpg, jpeg) no mayor a 20MB')" class="underline" />
						</div>

						<!--Acta Nacimiento -->
						<div class="mt-4 col-span-2">
							<x-input-label for="acta_nacimiento" :value="__('Acta de Nacimiento')" />
							<x-input-file id="acta_nacimiento" accept="pdf/*" />
							<x-input-error :messages="$errors->get('acta_nacimiento')" class="mt-2" />
							<x-input-label :value="__('Ingrese una imagen (png, jpg, jpeg) no mayor a 20MB')" class="underline" />
						</div>

						<!-- Comprobante Domicilio -->
						<div class="mt-4 col-span-2">
							<x-input-label for="comprobante_domicilio" :value="__('Comprobante de Domicilio')" />
							<x-input-file id="comprobante_domicilio" accept="pdf/*" />
							<x-input-error :messages="$errors->get('comprobante_domicilio')" class="mt-2" />
							<x-input-label :value="__('Ingrese una imagen (png, jpg, jpeg) no mayor a 20MB')" class="underline" />
						</div>
					</x-fieldset>
				@endif

				<x-fieldset label="Datos Fiscales" step="{{ auth()->user()->role === 'admin' ? 2 : 1 }}">
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

				<x-fieldset label="Domicilios" step="{{ auth()->user()->role === 'admin' ? 3 : 2 }}">
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

				<x-fieldset label="Productos" step="{{ auth()->user()->role === 'admin' ? 4 : 3 }}">
					<x-slot name="dinamic_input">
						<x-dinamic-input :headers="['Nombre Producto', 'Descripcion', 'Produccion Mensual', 'Ventas Mensuales', 'Ventas Anuales']" id_button="add_producto" id_message="message_productos_table_empty"
							id_table="productos_table" id_json="productos_json" value="{!! old('productos', $productos ?? '') !!}">
							<x-input-solicitud id="nombre_producto" label="Nombre Producto" type="text" />
							<x-input-solicitud id="descripcion_producto" label="Descripcion" type="text" class="lg:col-span-2" />
							<x-input-solicitud id="produccion_mensual" label="Produccion Mensual" type="number" />
							<x-input-solicitud id="ventas_mensuales" label="Ventas Mensuales" type="number" />
							<x-input-solicitud id="ventas_anuales" label="Ventas Anuales" type="number" />
						</x-dinamic-input>
					</x-slot>
				</x-fieldset>

				<x-fieldset label="Redes Sociales" step="{{ auth()->user()->role === 'admin' ? 5 : 4 }}">
					<x-slot name="dinamic_input">
						<x-dinamic-input :headers="['Red Social', 'Nombre', 'Enlace']" id_button="add_red_social"
							id_message="message_redes_sociales_table_empty" id_table="redes_sociales_table"
							id_json="redes_sociales_json" value="{!! old('redes_sociales', $redes_sociales ?? '') !!}">
							<x-input-solicitud id="red_social" label="Red Social" type="select" :options="['Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Instagram' => 'Instagram']" />
							<x-input-solicitud id="nombre_red_social" label="Nombre" type="text" />
							<x-input-solicitud id="enlace_red_social" label="Enlace" type="text" />
						</x-dinamic-input>
					</x-slot>
				</x-fieldset>

				<x-fieldset label="Documentos" step="{{ auth()->user()->role === 'admin' ? 6 : 5 }}">
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