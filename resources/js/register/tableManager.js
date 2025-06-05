export class TableManager{

	//obtencion del id de la tabla (objeto), definimos un array que nos servira para almacenar el conjunto de datos
	constructor (table_data){
		this.tableElement = table_data.table;
		this.message = table_data.message;
		this.inputs = table_data.inputs;
		this.json = table_data.json;
		console.log(!(!this.tableElement), !(!this.message), !(!this.inputs), !(!this.json));
		// Verificación defensiva para evitar errores si la tabla no existe
		if (!this.tableElement) {
			console.error('TableManager: No se encontró el elemento de la tabla. Revisa que el id o referencia sea correcto.');
			return;
		}
		this.tableBody = this.tableElement.getElementsByTagName('tbody')[0];
		this.array_data = []; // conjunto de datos

		this.comprobation_empty_json(); //verificamos si el json tiene datos para llenar la tabla
	}
	comprobation_empty_json(){

		if(this.json.value && this.json.value !== ""){
			try{
				this.array_data = JSON.parse(this.json.value);
				// Verificar que array_data sea realmente un array
				if(Array.isArray(this.array_data)){
					this.array_data.forEach((data)=>{
						this.addRow(data);
					});
				} else {
					// Si no es un array, inicializarlo como uno vacío
					console.warn("El valor parseado no es un array, inicializando como array vacío");
					this.array_data = [];
				}
			} catch (e){
				console.error("Hubo un error", e);
				// En caso de error, asegurarse de que array_data sea un array vacío
				this.array_data = [];
			}
		} else {
			// Si no hay valor, inicializar como array vacío
			this.array_data = [];
		}
	}

	fillTable(){
		const data = []
		this.inputs.forEach((input)=>{
			data.push(input.value);
			input.value = ''
		});
		this.array_data.push(data)

		
		this.addRow(data);
		console.log(JSON.stringify(this.array_data))
		this.json.value = JSON.stringify(this.array_data)
	}

	//metodo para agregar una fila a la tabla, recibe un array con los datos de la fila
	addRow (data){
		//elimina el mensaje de tabla vacia si existe
		this.clearMessage();


		//Creacion de la nueva fila y llenado de celdas con los datos
		const newRow = this.tableBody.insertRow();
		data.forEach((cellData, i) => {
			const newCell = newRow.insertCell();
			newCell.textContent = cellData;
		});

		//boton para eliminar la fila
		const optionsCell = newRow.insertCell();
		const deleteButton = document.createElement('button');
		deleteButton.textContent = 'Eliminar';
		deleteButton.className = 'bg-primary rounded-md text-white  font-bold px-2 py-1 hover:bg-red-700 hover:cursor-pointer transition duration-150';
		//añadir funcionalidad para eliminar la fila del boton
		deleteButton.addEventListener('click', (i) => {
			this.array_data.splice(newRow.rowIndex - 1, 1); 
			this.json.value = JSON.stringify(this.array_data)
			newRow.remove();
			this.checkEmptyTable();
		}); 
		optionsCell.appendChild(deleteButton);

		// FUNCIONALIDAD DE EDITAR PARA PROXIMOS PLANES
		const editButton = document.createElement('button');
		editButton.textContent = 'Editar';
		editButton.className = 'bg-secondary rounded-md text-white font-bold px-2 py-1 hover:bg-green-700 hover:cursor-pointer ml-2 transition duration-150';
		editButton.addEventListener('click', () => {
		
			this.inputs.forEach((input, index) => {
				input.value = newRow.cells[index].textContent;
			});
			this.array_data.splice(newRow.rowIndex - 1, 1); // Eliminar la fila del array de datos
			newRow.remove();
			this.checkEmptyTable();
		}); 
		optionsCell.appendChild(editButton);
	}


	//metodo para agregar un mensaje de tabla vacia
	showEmptyTableMessage (){
		const emptyRow = this.tableBody.insertRow();
		emptyRow.id = `message_${this.tableElement.id}_empty`;
		console.log(emptyRow.id)
		const emptyCell = emptyRow.insertCell();
		emptyCell.colSpan = this.tableElement.rows[0].cells.length;
		emptyCell.textContent = 'No hay datos disponibles';
		emptyCell.classList.add('px-6','py-4', 'whitespace-nowrap', 'text-center', 'text-sm', 'text-gray-500');
	}

	//metodo para eliminar el mensaje de tabla vacia
	clearMessage (){
		const message = document.getElementById(`message_${this.tableElement.id}_empty`)
		if (message) {
			message.remove();
		}
	}

	//metodo para verificar si la tabla esta vacia y mostrar el mensaje correspondiente
	checkEmptyTable (){
		if (this.tableBody.rows.length === 0) {
			this.showEmptyTableMessage();
		}
		else {
			this.clearMessage();
		}
	} 

	
}