import {MultiStepForm} from './navigateForm';
import {inputsTable} from '../constants/inputsTable';
import { TableManager } from './tableManager';

export class Register {
  constructor() {
    this.init();
  }

  init(){
    
    new MultiStepForm()
    this.DefineButtonsAddTable();
    
  }

  DefineButtonsAddTable(){
    const managerDomicilios = new TableManager (inputsTable.domicilios) ;
    document.getElementById('add_domicilio').addEventListener('click', () =>{
      managerDomicilios.fillTable()
    })
    const managerProductos = new TableManager (inputsTable.productos) ;
    document.getElementById('add_producto').addEventListener('click', () =>{
      managerProductos.fillTable()
    })
    const managerMediosDigitales = new TableManager (inputsTable.medios_digitales) ;
    document.getElementById('add_red_social').addEventListener('click', () =>{
      managerMediosDigitales.fillTable()
    })    
  }
}