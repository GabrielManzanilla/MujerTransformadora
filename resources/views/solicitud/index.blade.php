@php
	$users = [
		['name' => 'John Doe', 'email' => 'EMAIL', 'phone' => '1234567890'],
		['name' => 'Jane Doe', 'email' => 'EMAIL', 'phone' => '1234567890'],
		['name' => 'John Smith', 'email' => 'EMAIL', 'phone' => '1234567890'],
	]
@endphp
<x-app-layout>
	<div>
		<x-table 	:title="'Solicitudes'"
							:headers="['Status', 'Name', 'Email', 'Phone']"
							:items="['name', 'email', 'phone']"
							:data=$users>

		</x-table>
	</div>
</x-app-layout>