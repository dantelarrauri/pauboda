<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Swal from "sweetalert2";
import html2pdf from "html2pdf.js";
import QRCode from 'qrcode-generator';
import PDFMAKER from "@/Components/PDFMAKER.vue"
import { watch } from "vue";


const props = defineProps({
    invitacion: { type: Object/* , default: () => ({}) */ },
    modal: String,
    title: String,
    op: { type: String, default: "2" },
});
const form = useForm({
    id: props.invitacion?.id,
    Keyinvited: props.invitacion?.Keyinvited,
    nombre: props.invitacion?.nombre,
    confirmacion: props.invitacion?.confirmacion,
    protegido: props.invitacion?.protegido,
    username: props.invitacion?.username,


});
const save = () => {
    form.post(route("invitacion.store"), {
        onSuccess: () => PopupSucces()
    });
};
const update = () => {
    if (form.nombre === "Ingresa tú nombre") {
        Swal.fire({
            title: '¡Atención!',
            text: 'Parece que olvidaste cambiar tu nombre',
            icon: 'warning',
            confirmButtonText: 'Aceptar',
        });
        // Aquí puedes mostrar un mensaje de error o realizar alguna acción
        return;
    }
    var keyinvited = document.getElementById("Keyinvited2").value;
    form.put(route("invitacion.updateExtern", { username: form.username, keyinvited: keyinvited }), {
        onSuccess: () => {
            if (form.confirmacion) {
                PopupSuccessWithDownload();
            } else {
                PopupSuccess();
            }
        }
    }
    );
};

const cerrar = () => {
    form.reset();
    /* document.querySelector('#cerrar'+props.op).click(); */

};

const pdfcreator = () => {
    var element = document.getElementById('element-to-pdf');
    var divOcultarForm = document.getElementById('OcultarForm');
    var divQRShow = document.getElementById('QRShow');
    divOcultarForm.style.visibility = 'hidden';
    divQRShow.style.display = 'flex';
    const options = {
        filename: 'documento.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: [206, 1085], orientation: 'portrait' },

    };

    html2pdf().from(element).set(options).save();
    setTimeout(() => {
        divOcultarForm.style.display = 'inline';
        divQRShow.style.display = 'none';
    }, 10);
};

const enlace = window.location.origin + '/invitacion/' + form.username + '/' + form.Keyinvited + '/asistencia';
const qr = QRCode(0, 'M');
qr.addData(enlace);
qr.make();

var enlaceqr = qr.createDataURL(5, 5);

const PopupSuccessWithDownload = () => {
    const enlace = window.location.origin + '/invitacion/' + form.username + '/' + form.Keyinvited + '/asistencia';
    const qr = QRCode(0, 'M');
    qr.addData(enlace);
    qr.make();

    var enlaceqr = qr.createDataURL(10, 5);

    Swal.fire({
        title: '¡Éxito!',

        icon: 'success',
        confirmButtonText: 'Aceptar',
        /* imageUrl: qr.createDataURL(10, 5), */
        html: '<button class="btn bg-[#69f935]" id="pdfcreator"> <i class="fa-solid fa-floppy-disk"> </i> Descargar invitación</button>',
        text: 'Haz confirmado tu participación correctamente.',
    });
    document.getElementById('pdfcreator').addEventListener('click', pdfcreator);

};
const PopupSuccess = () => {

    Swal.fire({
        title: '¡Tu respuesta se ha guardado!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        text: '😥¡Es una pena que no nos acompañes! 😥             Muchas gracias por confirmar,',

    });

};

function MiComponente() {



    document.getElementById('id2').value = props.invitacion?.id;
    document.getElementById('Keyinvited2').value = props.invitacion?.Keyinvited;
    document.getElementById('nombre2').value = props.invitacion?.nombre;
    document.getElementById('confirmacion2').checked = props.invitacion?.confirmacion;
/*         document.getElementById('protegido2').checked = props.invitacion?.protegido;
 */};

setTimeout(MiComponente, 10);

let isLargeScreen = true;
const checkScreenSize = () => {
    isLargeScreen = window.innerWidth >= 500 && window.innerHeight >= 900;

}
checkScreenSize();
window.addEventListener('resize', checkScreenSize);



watch(
      () => form.confirmacion,
      (newVal) => {
        if (newVal) {
          form.protegido = true;
        } else {
          form.protegido = false;
        }
      }
    );


</script>
<style>
@media print {
    .ocultar-al-imprimir {
        display: none;
    }

    .mostrar-al-imprimr {
        display: inline;
    }
}
</style>
<template>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap" rel="stylesheet"> .

    </head>
    <!--  <template><PDFMAKER v-show="false" ref="elementToPDF" :content="enlaceqr"/></template> -->

    <div class="bg-[#fff] ">




        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid " style="justify-content: center;">
    <a class="navbar-brand" href="#">Navbar</a>
    
    <div class=" navbar-collapse" id="navbarSupportedContent" style="justify-content: center; ">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="align-items: center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav> -->


        <div class="container-sm bg-[#e8e2e6] shadow-lg shadow-black " id="element-to-pdf"
            :style="{ 'background-image': 'url(/image/ramapaint.png)', 'background-repeat': 'repeat-x', 'background-position': 'bottom', 'background-size': isLargeScreen ? '228px' : '144px' }">
            <div
                :style="{ 'background-image': 'url(/image/ramapaint.png)', 'background-repeat': 'repeat-x', 'background-position': 'top', 'background-size': isLargeScreen ? '228px' : '144px' }">
                <div
                    :style="{ 'background-image': 'url(/image/ramapaint2.png)', 'background-repeat': 'repeat-y', 'background-position': 'right', 'background-size': isLargeScreen ? '32px' : '18px' }">
                    <div :class="{ 'p-12': isLargeScreen, 'p-6': !isLargeScreen }"
                        :style="{ 'background-image': 'url(/image/ramapaint2.png)', 'background-repeat': 'repeat-y', 'background-position': 'left', 'background-size': isLargeScreen ? '32px' : '18px' }">

                        <div class="  flex  justify-center p-2">
                            <img class=" min-w-[20rem] max-w-sm  " :src="'/image/ESCUDO-min.png'" alt="logo">
                        </div>
                        <div class="  flex  justify-center p-2">
                            <img class=" min-w-[20rem] max-w-sm  " :src="'/image/PyC1.png'" alt="logo">
                        </div>
                        <div class="flex p-2 text-center  justify-center">
                            <span class=" max-w-lg "
                                style="font-family: 'IM Fell English', serif; font-size: 25px; color: #686868;">
                                Unidos por el amor y en compañía de nuestras familias, queremos compartir contigo la
                                felicidad de nuestra unión
                            </span>
                        </div>
                        <div class="  flex  justify-center p-2">
                            <img class=" min-w-[19rem] max-w-[50rem] " :src="'/image/LUGARS-min.png'" alt="logo">
                        </div>
                        <div class="  flex  justify-center p-2">
                            <img class=" min-w-[16rem] max-w-sm " :src="'/image/itinerarioverticalllll-min.png'" alt="logo">
                        </div>
                        <div class="  flex  justify-center p-2">
                            <img class=" min-w-[20rem] max-w-sm absolute z-0  " :src="'/image/mancha-min.png'" alt="logo">
                            <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="'/image/Dresscode-min.png'" alt="logo">
                        </div>
                        <div class="flex p-2 text-center  justify-center flex-column items-center">
                            <span class=" max-w-lg "
                                style="font-family: 'IM Fell English', serif; font-size: 25px; color: #686868;">
                                Ven a celebrar con nosotros este
                            </span>
                            <div class="flex justify-items-center m-8">
                                <span class=" max-w-lg "
                                    style="font-family: 'IM Fell English', serif; font-size: 35px; color: #686868;">
                                    16
                                </span>
                                <span class=" max-w-lg "
                                    style="font-family: 'IM Fell English', serif; font-size: 50px; color: #7ea271;">
                                    Sept
                                </span>
                                <span class=" max-w-lg flex items-end"
                                    style="font-family: 'IM Fell English', serif; font-size: 35px; color: #686868;">
                                    2023
                                </span>
                            </div>
                            <span class=" max-w-lg  m-4"
                                style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">
                                En esta ocasión, nuestra invitación se extiende únicamente a mayores de edad. Agradecemos su
                                comprensión.
                            </span>
                        </div>

                        <div class="  flex  min-w-[20rem] justify-center m-4   flex-column items-center">
                            <img class=" min-w-sm max-w-[15rem]  " :src="'/image/Capa2rega.png'" alt="logo">
                            <div class="row">
                                <div class="flex flex-col col-sm-6">
                                    <img class=" min-w-sm max-w-[8rem]  " :src="'/image/Capa3rega.png'" alt="logo">
                                    <a class="" href="https://mesaderegalos.liverpool.com.mx/milistaderegalos/51169198"
                                        target="_blank"
                                        style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Evento:
                                        Enlace Paulina y Carlos </a>
                                    <a class="" href="https://mesaderegalos.liverpool.com.mx/milistaderegalos/51169198"
                                        target="_blank"
                                        style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Núm.
                                        evento: 51169198 </a>
                                    <!--                         <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="'/image/REGALOS2-min.png'" alt="logo">
    --> <img class=" min-w-sm max-w-[8rem]  " :src="'/image/Capa4rega.png'" alt="logo">
                                    <a class="" href="https://amz.run/6sNm" target="_blank"
                                        style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Enlace:
                                        https://amz.run/6sNm </a>
                                </div>
                                <div class="col-sm-4 ">
                                    <img class=" min-w-[5rem] max-w-[15rem]  " :src="'/image/Capa5rega.png'" alt="logo">
                                </div>
                            </div>
                            <!--                         <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="'/image/REGALOS2-min.png'" alt="logo">
 -->
                        </div>
                        <div class="  flex  justify-center  p-2">
                            <img class=" min-w-sm max-w-[15rem]  " :src="'/image/Pase_personal_.png'" alt="logo">
                        </div>
                        <div class="flex p-2  text-center justify-center">
                            <span class=" max-w-lg "
                                style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">
                                Confirma tu asistencia y genera tu código QR para poder accesar al evento. Este código es
                                único, válido únicamente con la persona que ha confirmado su asistencia.
                            </span>
                        </div>
                        <div class="  flex  justify-center p-2 mostrar-al-imprimir" id="QRShow" style="display: none;">
                            <img class=" min-w-[12rem] max-w-sm relative z-1 " :src="enlaceqr" alt="QR">
                        </div>
                        <div class="card p-2 bg-[#ffffff52] ocultar-al-imprimir" id="OcultarForm">
                            <form @submit.prevent="op === '1' ? save() : update()" action="">
                                <TextInput :id="'id' + op" type="hidden" name="id" v-model="form.id">
                                </TextInput>
                                <TextInput :id="'Keyinvited' + op" type="hidden" name="Keyinvited"
                                    v-model="form.Keyinvited">
                                </TextInput>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-person"></i>
                                    </span>
                                    <TextInput :id="'nombre' + op" class="form-control" type="text" name="nombre"
                                        v-model="form.nombre" maxlength="120" placeholder="Nombre"
                                        :disabled="props.invitacion?.protegido">
                                    </TextInput>
                                </div>
                                <div v-if="form.errors.nombre" class="text-sm text-danger">
                                    {{ form.errors.nombre }}
                                </div>

                                <div class="input-group mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" :for="'confirmacion' + op">Confirmar
                                            asistencia</label>
                                        <input :id="'confirmacion' + op" class="form-check-input" type="checkbox"
                                            name="confirmacion" v-model="form.confirmacion" />
                                    </div>
                                </div>
                            <div v-if="form.errors.confirmacion" class="text-sm text-danger">
                                {{ form.errors.confirmacion }}
                            </div>

                            <div v-if="form.errors.protegido" class="text-sm text-danger">
                                {{ form.errors.protegido }}
                            </div>
                            <!-- ###### -->
                            <div class="d-grid mx-auto">
                                <button class="btn bg-[#7ea271]" :disabled="form.processing">
                                    <i class="fa-solid fa-floppy-disk"> </i>
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="  flex  justify-center p-2">
                        <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="qr.createDataURL(10, 5)" alt="logo">
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div></template>