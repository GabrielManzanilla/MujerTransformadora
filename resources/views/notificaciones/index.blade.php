@php
	$notifications = [
		['title' => 'Nueva solicitud', 'message' => 'Se ha recibido una nueva solicitud de contacto.', 'date' => '2023-10-01', 'status'=> 'unread'],
		['title' => 'Actualización de perfil', 'message' => 'Tu perfil ha sido actualizado correctamente.', 'date' => '2023-10-02', 'status'=> 'unread'],
		['title' => 'Recordatorio de cita', 'message' => 'Tienes una cita programada para mañana.', 'date' => '2023-10-03', 'status'=> 'readed'],
	];
	$totalNotifications = collect($notifications)->where('status', 'unread')->count();


@endphp
<x-app-layout>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 flex flex-row items-center gap-2">
						{{ __('Notificaciones') }}
						<div class="bg-primary rounded-full w-5 h-5 text-white text-sm font-bold flex flex-col items-center">{{  $totalNotifications }}</div>
					</h2>

					@foreach ($notifications as $notification)
						<div>
							<div class="{{ $notification['status'] == 'unread'? 'bg-primary text-secondary' :  'bg-gray-100 text-black' }} p-4 mb-4 rounded-lg shadow">
								<h3 class="font-bold text-lg">{{ $notification['title'] }}</h3>
								<div class="flex justify-between">
									<p class="{{ $notification['status'] == 'unread'? 'bg-primary text-white': 'text-gray-700'}} ">{{ $notification['message'] }}</p>
									<span class="text-secondary italic underline font-semibold text-sm">{{ $notification['date'] }}</span>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</x-app-layout>