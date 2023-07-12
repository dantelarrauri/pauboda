<script setup>
import Swal from "sweetalert2";
import QRCode from 'qrcode-generator';


const props = defineProps({
    content: Object
});




const PopupSucces = () => {
    const enlace = window.location.origin + '/invitacion/' + form.username + '/' + form.Keyinvited+'/asistencia';
    const qr = QRCode(0, 'M');
    qr.addData(enlace);
    qr.make();
    Swal.fire({
        title: '¡Éxito!',
        text: 'Haz confirmado tu participación correctamente.',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        imageUrl: qr.createDataURL(10, 5),
    });
};




let isLargeScreen = true;
const checkScreenSize = () => {
      isLargeScreen = window.innerWidth >= 500 && window.innerHeight >= 900;
      console.log(isLargeScreen)
      console.log(window.innerWidth)
      console.log(window.innerHeight)
    }
checkScreenSize();
window.addEventListener('resize', checkScreenSize);


</script>
<template>
    
    <div class="bg-[#e8e2e6] " ref="elementToPDF"  id="elementToPDF" >



<div class="container-sm bg-[#e8e2e6] " :style="{'background-image': 'url(/image/ramapaint.png)','background-repeat': 'repeat-x','background-position': 'buttom','background-size': isLargeScreen ? '228px' : '144px'}">
<div :style="{'background-image': 'url(/image/ramapaint.png)','background-repeat': 'repeat-x','background-position': 'top','background-size': isLargeScreen ? '228px' : '144px'}"> 
    <div :style="{'background-image': 'url(/image/ramapaint2.png)','background-repeat': 'repeat-y','background-position': 'right','background-size': isLargeScreen ? '32px' : '18px'}">   
<div :class="{'p-12': isLargeScreen, 'p-6': !isLargeScreen}" :style="{'background-image': 'url(/image/ramapaint2.png)','background-repeat': 'repeat-y','background-position': 'left','background-size': isLargeScreen ? '32px' : '18px'}">                         

            <div class="  flex  justify-center p-2">
                <img class=" min-w-[20rem] max-w-sm  " :src="'/image/ESCUDO-min.png'" alt="logo">
            </div>
            <div class="  flex  justify-center p-2">
                <img class=" min-w-[20rem] max-w-sm  " :src="'/image/PyC1.png'" alt="logo">
            </div>
            <div class="flex p-2 text-center  justify-center">
                <span class=" max-w-lg " style="font-family: 'IM Fell English', serif; font-size: 25px; color: #686868;">
                    Unidos por el amor y en compañía de nuestras familias, queremos compartir contigo la felicidad de nuestra unión
                </span>
            </div>
            <div class="  flex  justify-center p-2">
                <img class=" min-w-[19rem] max-w-[50rem] " :src="'/image/LUGARS-min.png'" alt="logo">
            </div>
            <div class="  flex  justify-center p-2">
                <img class=" min-w-[37rem]   " :src="'/image/itinerario verticalllll-min.png'" alt="logo">
            </div>
            <div class="  flex  justify-center p-2">
                <img class=" min-w-[20rem] max-w-sm absolute z-0  " :src="'/image/mancha-min.png'" alt="logo">
                <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="'/image/Dresscode-min.png'" alt="logo">
            </div>
            <div class="flex p-2 text-center  justify-center flex-column items-center">
                <span class=" max-w-lg " style="font-family: 'IM Fell English', serif; font-size: 25px; color: #686868;">
                    Ven a celebrar con nosotros este 
                </span>
                <div class="flex justify-items-center m-8">
                    <span class=" max-w-lg " style="font-family: 'IM Fell English', serif; font-size: 35px; color: #686868;">
                        16 
                    </span>
                    <span class=" max-w-lg " style="font-family: 'IM Fell English', serif; font-size: 50px; color: #7ea271;">
                        Sept 
                    </span>
                    <span class=" max-w-lg flex items-end" style="font-family: 'IM Fell English', serif; font-size: 35px; color: #686868;">
                        2023 
                    </span>
                </div>
                <span class=" max-w-lg  m-4" style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">
                    En esta ocasión, nuestra invitación se extiende únicamente a mayores de edad. Agradecemos su comprensión. 
                </span>
            </div>
            
            <div class="  flex  min-w-[20rem] justify-center m-4   flex-column items-center">
                <img class=" min-w-sm max-w-[15rem]  " :src="'/image/Capa2rega.png'" alt="logo">
                <div class="row">
                    <div class="flex flex-col col-sm-6 m-2">
                        <img class=" min-w-sm max-w-[8rem]  " :src="'/image/Capa3rega.png'" alt="logo">
                        <a class="" href="https://amz.run/6jQN" style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Evento: Enlace Paulina y Carlos </a>
                        <a class="" href="https://amz.run/6jQN" style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Núm. evento: 51169198 </a>
<!--                         <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="'/image/REGALOS2-min.png'" alt="logo">
-->                         <img class=" min-w-sm max-w-[8rem]  " :src="'/image/Capa4rega.png'" alt="logo">
                        <a class="" href="https://amz.run/6jQN" style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">Enlace: https://amz.run/6jQN </a>
                    </div>
                    <div class="col-sm-4 m-2">
                        <img class=" min-w-[10rem] max-w-[15rem]  " :src="'/image/Capa5rega.png'" alt="logo">
                    </div>
                </div>
                 </div>
            <div class="  flex  justify-center  p-2">
                <img class=" min-w-sm max-w-[15rem]  " :src="'/image/Pase_personal_.png'" alt="logo">
            </div>
            <div class="flex p-2  text-center justify-center">
                <span class=" max-w-lg " style="font-family: 'IM Fell English', serif; font-size: 18px; color: #686868;">
                    Confirma tu asistencia y genera tu código QR para poder accesar al evento. Este código es único, válido únicamente con la persona que ha confirmado su asistencia.
                </span>
            </div>
                <div class="  flex  justify-center p-2">
                    <img class=" min-w-[20rem] max-w-sm relative z-1 " :src="content" alt="QR">
                </div> 
            
            

        </div>
</div></div> </div></div>
</template>