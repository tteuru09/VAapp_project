/* import './bootstrap'; */
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'flowbite';
import { Carousel, Collapse, Input, Datepicker, Select, Timepicker, Modal, Ripple, initTE } from "tw-elements";
initTE({ Carousel, Collapse , Input, Modal, Ripple, Select }); // set second parameter to true if you want to use a debugger

//Delete modal
const modalDelete = document.getElementById('modalDelete');
modalDelete.addEventListener('show.te.modal', (e) => {
  
  const button = e.relatedTarget;
  
  const slot = button.getAttribute('data-te-whatever');
  
  const inputToChange = modalDelete.querySelector("#ModalFooter input[name='slot_id']");
  inputToChange.value = slot;
})

//Edit modal 
const modalEdit = document.getElementById('modalEdit');
modalEdit.addEventListener('show.te.modal', (e) => {
  const button = e.relatedTarget;

  //Constantes
  const params = JSON.parse(button.getAttribute('data-te-whatever'));
  console.log(params)
  const date = params.slot.date.split("-");
  const start_time = params.slot.start_time.split(":");
  const end_time = params.slot.end_time.split(":");

  // Recup les inputs
  const slotID = modalEdit.querySelector("#ModalEditBody input[name='slot_id']");
  const dateEdit = modalEdit.querySelector("#ModalEditBody input[name='dateEdit']");
  const timeStartEdit = modalEdit.querySelector("#ModalEditBody input[name='timeStartEdit']");
  const timeEndEdit = modalEdit.querySelector("#ModalEditBody input[name='timeEndEdit']");
  const selectCanoes = modalEdit.querySelector("#ModalEditBody select[name='canoes[]']");
  const selectRowers = modalEdit.querySelector("#ModalEditBody select[name='rowers[]']");
  
  const canoesLength = selectCanoes.options.length
  const rowersLength = selectRowers.options.length

  for (let i = 0; i < canoesLength; i++) {
    selectCanoes.options[i].removeAttribute('selected')
  }

  for (let i = 0; i < rowersLength; i++) {
    selectRowers.options[i].removeAttribute('selected')
  }

  Object.keys(params.canoes).forEach(key => {
    selectCanoes.options.namedItem(params.canoes[key].ref_canoe).setAttribute("selected",'')
  });

  Object.keys(params.rowers).forEach(key => {
    selectRowers.options.namedItem(params.rowers[key].ref_rower).setAttribute("selected",'')
  });

  // Change value of inputs
  slotID.value = params.slot.id;
  dateEdit.value = date[2] + "-" + date[1] + "-" + date[0];
  timeStartEdit.value = start_time[0] + ":" + start_time[1];
  timeEndEdit.value = end_time[0] + ":" + end_time[1];
})


//New slot date time
const new_slot_date = document.getElementById('dateID');
new Datepicker(new_slot_date, {
  disablePast: true
});

const picker1 = document.getElementById("timeStart");
const picker2 = document.getElementById("timeEnd");
new Timepicker(picker1, {
  format24: true
});
new Timepicker(picker2, {
  format24: true,
});


//Edit slot date time
const edit_slot_date = document.getElementById('editDateID');
new Datepicker(edit_slot_date, {
  disablePast: true
});

const editPicker1 = document.getElementById("timeStartEdit");
const editPicker2 = document.getElementById("timeEndEdit");
new Timepicker(editPicker1, {
  format24: true
});
new Timepicker(editPicker2, {
  format24: true,
});