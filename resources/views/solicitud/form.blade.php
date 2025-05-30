<x-app-layout>
	<div class="w-full h-full p-4">
		<div class="w-full h-full rounded-lg overflow-y bg-white shadow-md p-2">
			<x-form>
				
				<x-fieldset label="Datos Personales" step="1">
					<x-input-solicitud id="name" label="Nombre Completo" type="text" />
					<x-input-solicitud id="email" label="Correo Electrónico" type="email" />
					<x-input-solicitud id="phone" label="Teléfono" type="tel" />
				</x-fieldset>
				<x-fieldset label="Información de la Solicitud" step="2">
					<x-input-solicitud id="subject" label="Asunto" type="text" />
					<x-input-solicitud id="description" label="Descripción" type="textarea" />
					<x-input-solicitud id="priority" label="Prioridad" type="select" :options="['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja']" />
					<x-input-solicitud id="attachments" label="Adjuntos" type="file" />
				</x-fieldset>
			</x-form>
		</div>

	</div>

</x-app-layout>