<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Swal from "sweetalert2";
const props = defineProps({
    invitacion: { type: Object/* , default: () => ({}) */ },
    modal: String,
    title: String,
    op: { type: String, default: "2" },
});
const form = useForm({
    id: props.invitacion?.id,
    nombre: props.invitacion?.nombre,
    confirmacion: props.invitacion?.confirmacion,
    protegido: props.invitacion?.protegido,
    asistencia: props.invitacion?.asistencia,
    Keyinvited: props.invitacion.Keyinvited,
    username: props.invitacion.username,


});
const save = () => {
    form.post(route("invitacion.store"), {
        onSuccess: () => PopupSucces()
    });
};
const update = () => {
    var keyinvited = document.getElementById("Keyinvited2").value;
    form.put(route("invitacion.updateExtern", { username: form.username, keyinvited: keyinvited }), {
        onSuccess: () => PopupSucces()
    }
    );
};

const cerrar = () => {
    form.reset();
    /* document.querySelector('#cerrar'+props.op).click(); */

};
const PopupSucces = () => {
    Swal.fire({
        title: '¡Éxito!',
        text: 'Haz confirmado la asistencia del invitado correctamente.',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    });
};

function MiComponente() {


    console.log(props.invitacion?.asistencia)
    console.log(props.op)
    console.log(form.confirmacion)
    document.getElementById('id2').value = props.invitacion?.id;
    document.getElementById('nombre2').value = props.invitacion?.nombre;
    document.getElementById('asistencia2').checked = props.invitacion?.asistencia;
/*         document.getElementById('protegido2').checked = props.invitacion?.protegido;
 */};
setTimeout(MiComponente, 10);



</script>
<template>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap" rel="stylesheet"> .

    </head>
    <!--  <template><PDFMAKER v-show="false" ref="elementToPDF" :content="enlaceqr"/></template> -->

    <div class="bg-[#e8e2e6] p-4">

        <div class="container-sm bg-[#e8e2e6] " id="element-to-pdf "
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
                        <div class="  flex  justify-center  p-2">
                            <img class=" min-w-sm max-w-[15rem]  " :src="'/image/Pase_personal_.png'" alt="logo">
                        </div>
                        <div class="card p-2 bg-[#ffffff52] ocultar-al-imprimir items-center mb-12" id="OcultarForm">
                            <form @submit.prevent="op === '1' ? save() : update()" action="">
                                <TextInput :id="'id' + op" type="hidden" name="id" v-model="form.id">
                                </TextInput>
                                <TextInput :id="'Keyinvited' + op" type="hidden" name="Keyinvited"
                                    v-model="form.Keyinvited">
                                </TextInput>
                                <h3 class="text-center"
                                    style="font-family: 'IM Fell English', serif; font-size: 25px; color: #686868;"> Nombre
                                    del invitado</h3>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-person"></i>
                                    </span>
                                    <span :id="'nombre' + op" type="text" name="nombre">

                                        {{ form.nombre }}
                                    </span>
                                </div>
                                <div v-if="form.errors.nombre" class="text-sm text-danger">
                                    {{ form.errors.nombre }}
                                </div>

                                <div class="input-group mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" :for="'asistencia' + op">Confirmar
                                            asistencia</label>
                                        <input :id="'asistencia' + op" class="form-check-input" type="checkbox"
                                            name="asistencia" v-model="form.asistencia" />
                                    </div>
                                </div>
                                <div v-if="form.errors.asistencia" class="text-sm text-danger">
                                    {{ form.errors.asistencia }}
                                </div>

                                <div v-if="form.errors.protegido" class="text-sm text-danger">
                                    {{ form.errors.protegido }}
                                </div>
                                <!-- ###### -->
                                <div class="d-grid mx-auto">
                                    <button class="btn btn-success" :disabled="form.processing">
                                        <i class="fa-solid fa-floppy-disk"> </i>
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div></template>