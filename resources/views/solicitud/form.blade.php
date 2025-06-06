<x-app-layout>
	<div class="w-full h-full p-1">
		<div class="w-full h-full rounded-lg bg-white shadow-md p-2 m-0">
			<x-form>

				<x-fieldset label="Datos Fiscales" step="1">
					<x-input-solicitud id="actividad_economica" label="Actividad Economica" type="text" />
					<x-input-solicitud id="regimen" label="Regimen" type="text" />
					<x-input-solicitud id="nombre_comercial" label="Nombre Comercial" type="text" />
					<x-input-solicitud id="razon_social" label="Razon Social" type="text" />
					<x-input-solicitud id="clave_imss" label="Clave IMSS" type="text" />
					<x-input-solicitud id="clave_impi" label="Clave IMPI" type="text" />
					<x-input-solicitud id="clave_affy" label="Clave AFFY" type="text" />
					<x-input-solicitud id="clave_sat" label="Clave SAT" type="text" />
				</x-fieldset>
				<x-fieldset label="Domicilios" step="2">
					<!-- <x-input-solicitud id="priority" label="Prioridad" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" /> -->
					<x-slot name="dinamic_input">
						<x-dinamic-input :headers="['Direccion', 'Estado', 'Municipio', 'Localidad']" id_button="add_domicilio"
							id_message="message_domicilios_table_empty" id_table="domicilios_table" id_json="domicilios_json">
							<x-input-solicitud id="direccion" label="Direccion" type="text" />
							<x-input-solicitud id="estado_domiclio" label="Estado" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
							<x-input-solicitud id="municipio_domicilio" label="Municipio" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
							<x-input-solicitud id="localidad_domicilio" label="Localidad" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
						</x-dinamic-input>
					</x-slot>
				</x-fieldset>
			</x-form>
		</div>

	</div>

</x-app-layout>