<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
const props = defineProps({
    invitacion: { type: Object, default: () => ({}) },
    modal: String,
    title: String,
    op: String,
});
/* const form = useForm({
    id: props.invitacion?.id,
    nombre: props.invitacion?.nombre,
    confirmacion: props.invitacion?.confirmacion,
    protegido: props.invitacion?.protegido
}); */

const form = useForm({
    id: props.invitacion?.id,
    nombre: props.invitacion?.nombre ,
    confirmacion: props.invitacion?.confirmacion ,
    protegido: props.invitacion?.protegido ,
});

const save = () => {
    form.post(route("invitacion.store"), {
        onSuccess: () => cerrar(),
    });
};
const update = () => {
    var id = document.getElementById("id2").value;
    form.put(route("invitacion.update", id), {
        onSuccess: () => cerrar(),
    });
};

const cerrar = () => {
    form.reset();
    document.querySelector("#cerrar" + props.op).click();
};
</script>
<template>
    <div class="modal" :id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="h5">
                        {{ title }}
                    </label>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent="op === '1' ? save() : update()" action="">
                        <TextInput :id="'id' + op" type="hidden" name="id" v-model="form.id">
                        </TextInput>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-person"></i>
                            </span>
                            <TextInput :id="'nombre' + op" class="form-control" type="text" name="nombre"
                                v-model="form.nombre" maxlength="120" placeholder="Nombre" >
                            </TextInput>
                        </div>
                        <div v-if="form.errors.nombre" class="text-sm text-danger">
                            {{ form.errors.nombre }}
                        </div>

                        <div class="input-group mb-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label" :for="'confirmacion' + op">Confirmación</label>
                                <input :id="'confirmacion' + op" class="form-check-input" type="checkbox"
                                    name="confirmación" v-model="form.confirmacion" />
                            </div>
                        </div>
                        <div v-if="form.errors.confirmacion" class="text-sm text-danger">
                            {{ form.errors.confirmacion }}
                        </div>

                        <!-- ###### -->

                        <div class="input-group mb-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label" :for="'protegido' + op">No editable</label>
                                <input :id="'protegido' + op" class="form-check-input" type="checkbox" name="proteger"
                                    v-model="form.protegido" />
                            </div>
                        </div>
                        <div v-if="form.nombre === 'Ingresa tú nombre' &&
                            form.protegido
                            ">
                            {{ form.errors.protegido }}
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
                <div class="modal-footer">
                    <button class="btn btn-green" type="submit" :id="'cerrar' + op" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
