<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <head title="Bienvenido">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap" rel="stylesheet"> .

    </head>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100   selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900   focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900   focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Entrar</Link>

                <!-- <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900   focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Registrarse</Link> -->
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="  flex  justify-center p-2">
                <img class=" min-w-[20rem] max-w-sm  " :src="'/image/ESCUDO-min.png'" alt="logo">
            </div>

            <div class="mt-16">
                <div class="flex items-center container-sm">




                    <div
                        class="scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="flex content-center flex-col items-center">
                            <div class="h-16 w-16 bg-[#fff7f3]  flex items-center justify-center rounded-full">
                                <div class="  flex  justify-center p-2">
                                    <img class=" min-w-[10rem] max-w-[15rem]  " :src="'/image/ramapaint.png'" alt="logo">
                                </div>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 ">¡Bienvenido!</h2>

                            <p class="mt-6 mb-6 text-gray-500  text-sm leading-relaxed fontpau text-center"
                                style="font-size: large;">
                                Gracias por visitar nuestra página. Para acceder a tu invitación para la boda, por favor
                                ingresa utilizando el enlace que te fue proporcionado. Este enlace personalizado te
                                permitirá disfrutar de todos los detalles y preparativos de este día especial.
                            </p>
                            <div class="  flex  justify-center p-2">
                                <img class=" min-w-[10rem] max-w-[15rem]  " :src="'/image/PyC1.png'" alt="logo">
                            </div>
                            <div class="h-16 w-16 bg-[#fff7f3]  flex items-center justify-center rounded-full">
                                <div class="  flex  justify-center p-2" style="rotate: 180deg;">
                                    <img class=" min-w-[10rem] max-w-[15rem]  " :src="'/image/ramapaint.png'" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500  sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://www.facebook.com/tomominkmx"
                            class="group inline-flex items-center hover:text-gray-700  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="-mt-px mr-1 w-5 h-5 stroke-gray-400  group-hover:stroke-gray-600 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            Creado con amor por Tomomink Studio
                        </a>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.fontpau {
    font-family: 'IM Fell English', serif;
    color: #686868;
}</style>
