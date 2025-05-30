export const inputsTable = {
	registros_adicionales: {
		table: document.getElementById('registros_fiscales_table'),
		message: document.getElementById('message_registros_fiscales_table_empty'),
		inputs: [
			document.getElementById('nombre_registro'),
			document.getElementById('clave_registro')
		],
		json: document.getElementById('registros_json')
	},
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
		table: document.getElementById('medios_digitales_table'),
		message : document.getElementById('message_medios_digitales_table_empty'),
		inputs: [
			document.getElementById('nombre_medio_adicional'),
			document.getElementById('medio_adicional_registro')
		],
		json: document.getElementById('medios_digitales_json')
	},
	documentos_adicionales:{
		table: document.getElementById('documentos_adicionales_table'),
		message : document.getElementById('message_documentos_adicionales_table_empty'),
		inputs: [
			document.getElementById('denominacion_documento_adicional'),
			document.getElementById('nombre_documento_adicional')
		],
		json: document.getElementById('documentos_adicionales_json')
	}
}