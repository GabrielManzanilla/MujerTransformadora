export const inputsTable = {

	domicilios: {
		table: document.getElementById('domicilios_table'),
		message : document.getElementById('message_domicilios_table_empty'),
		inputs: [
			document.getElementById('direccion'),
			document.getElementById('estado_domiclio'),
			document.getElementById('municipio_domicilio'),
			document.getElementById('localidad_domicilio')
		],
		json: document.getElementById('domicilios_json')
	},
	productos: {
		table: document.getElementById('productos_table'),
		message : document.getElementById('message_productos_table_empty'),
		inputs : [
			document.getElementById('nombre_producto'),
			document.getElementById('descripcion_producto'),
			document.getElementById('produccion_mensual'),
			document.getElementById('ventas_mensuales'),
			document.getElementById('ventas_anuales')
		],
		json: document.getElementById('productos_json')
	},
	medios_digitales: {
		table: document.getElementById('redes_sociales_table'),
		message : document.getElementById('message_redes_sociales_table_empty'),
		inputs: [
			document.getElementById('red_social'),
			document.getElementById('nombre_red_social'),
			document.getElementById('enlace_red_social')
		],
		json: document.getElementById('redes_sociales_json')
	}
}