<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Swal from "sweetalert2";
import { Head } from "@inertiajs/vue3";
import { useForm, Link } from "@inertiajs/vue3";
import ModalGuest from "@/Components/ModalGuest.vue";
import ClipboardJS from 'clipboard';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { useToast } from "vue-toastification";

const form = useForm({});
const props = defineProps({
    invitacion: { type: Object },
});
const eliminar = (id, name) => {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: "Quieres eliminar el usuario" + name,
        text: "Se eliminará completamente este usuario",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: '<i class = "fa-solid fa-check"></i> Si, Eliminar',
        cancelButtonText: '<i class = "fa-solid fa-ban"></i> Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('invitacion.destroy', id));
        }
    })
};

const openModal = (invitado) => {
    document.getElementById('id2').value = invitado?.id;
    document.getElementById('nombre2').value = invitado?.nombre;
    document.getElementById('confirmacion2').checked = invitado?.confirmacion;
    document.getElementById('protegido2').checked = invitado?.protegido;
    if (document.getElementById('protegido1')) {
        document.getElementById('protegido1').checked = false;
    };
    
};
const toast = useToast();



const  copiarEnlace = (username, Keyinvited) => {
      const enlace = window.location.origin + '/invitacion/' + username +'/' +Keyinvited;
      const boton = document.getElementById('miBoton');

      const clipboard = new ClipboardJS(boton, {
        text: () => enlace
      });
      
      clipboard.on('success', () => {
        console.log('Enlace copiado al portapapeles: ' + enlace);
        toast.info("I'm an info toast!");
        
        
        
        
      });
      

      clipboard.on('error', () => {
        console.log('Error al copiar el enlace');
      });

      clipboard.onClick({ currentTarget: boton });
    };

</script>
<template>
    <head title="Agregar invitados"></head>

    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 bg-white">
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <div class=" ">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="fa-solid fa-circle-plus"></i>Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="table-responsive">
                        <table class="table table-stripeted table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>¿Va a ir?</th>
                                    <th>Editable</th>
                                    <th>Asistió</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                    <th>link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-content-center" v-for="invitado, i in invitacion" :key="invitado.id">
                                    <td> {{ i + 1 }}</td>
                                    <td> {{ invitado?.nombre }}</td>
                                    <td>
                                        <i :class=" { 'fa-solid fa-check': invitado?.confirmacion, 'fa-solid fa-question': !invitado?.confirmacion }"
                                            :style="invitado?.confirmacion ? 'color: green;' : 'color: #dedede;'"></i>
                                    </td>
                                    <td>
                                        <i :class="{ 'fa-solid fa-lock': invitado?.protegido, 'fa-solid fa-lock-open': !invitado?.protegido }"
                                            :style="invitado?.protegido ? 'color: black;' : 'color: #dedede;'"></i>
                                    </td>
                                    <td>
                                        <i :class="{'fa-solid fa-calendar-check': invitado?.asistencia, 'fa-solid fa-calendar': !invitado?.asistencia }"
                                            :style="invitado?.asistencia ? 'color: green;' : 'color: #dedede;'"></i>
                                    </td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            @click="openModal(invitado)"> <i class="fa-solid fa-edit"></i></button> </td>
                                    <td>
                                        <button class="btn btn-danger" @click="eliminar(invitado.id, invitado.nombre)" id="miBoton">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn"  @click="copiarEnlace(invitado.username, invitado.Keyinvited)"><i class="fa-solid fa-link" ></i></button>
                                    
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

            
            <ToastContainer></ToastContainer>

            <ModalGuest :modal="'modalCreate'" :title="'Añadir invitado'" :op="'1'"></ModalGuest>
            <ModalGuest :modal="'modalEdit'" :title="'Editar invitado'" :op="'2'"></ModalGuest>

        </template>
    </AuthenticatedLayout>
</template>
