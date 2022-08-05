<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div v-if="!authorized">
                    <input class="form-control" placeholder="enter device public key" :type="passwordFieldType" v-model="public_key" />

                    <br>

                    <input class="form-control" placeholder="enter device private key" :type="passwordFieldType" v-model="private_key"/>

                    <br>

                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" type="password" @click="switchVisibility">
                        show / hide
                    </button>

                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="socketConnect">Connect</button>
                </div>
                <div v-else>
                    Device <b><mark>{{ device_id }}</mark></b> is connected now :)
                    <br>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="logout">logout</button>

                </div>
            </div>
        </div>
    </div>
    <hr/>
     <div v-if="authorized">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <Lightbulb :isOn="light_is_on"/>
                <div>
                    <RockerSwitch :size="0.9" :value="light_is_on" @change="isOn => (light_is_on = isOn)"/>
                </div>
            </div>
            <div class="col-md-4">
                <vue-thermometer
                    :value="temperature_value"
                    :min="-20"
                    :max="25"
                />
            </div>
            <div class="col-md-4">
                <heart
                    :bpm_value="bpm_value"
                    :heart_stop="heart_stop"
                />
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-8">
                <table class="leading-normal socket_table">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Payload
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody id="device_data">
                            <tr v-for="(data) in socket_data.slice().reverse()" :key="data.id">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                    <tree-view :data="data.payload" :options="{maxDepth: 10}"></tree-view>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                    <time-ago
                                        :datetime="data.created_at"
                                        :refresh="1"
                                        :locale="en"
                                        :tooltip="true"
                                        :long="false"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</template>
<style >
    .socket_table{
        max-height: 440px;
        overflow: auto;
        display: inline-block;
    }
</style>
<script>
import Vue from "vue";
import TimeAgo from "vue2-timeago";
import TreeView from "vue-json-tree-view";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
Vue.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 30,
    newestOnTop: true,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: true,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false,
    position: "bottom-right",
    timeout: 3048,
});
Vue.use(TreeView)
import Lightbulb from "./Lightbulb";
import heart from "./heart";
import RockerSwitch from "vue-rocker-switch";
import "vue-rocker-switch/dist/vue-rocker-switch.css";
import VueThermometer from 'vuejs-thermometer'
import Echo from "laravel-echo";
import Heart from './heart.vue';
window.Pusher = require("pusher-js");

function initialState (){
  return {
        light_is_on: false,
        bpm_value : 0,
        heart_stop : true,
        temperature_value : 0,
        socket_data: [],
        device_token: null,
        device_id: null,
        authorized: false,
        public_key: "",
        private_key: "",
        passwordFieldType: 'password',
    }
}

export default {
    components: {
    RockerSwitch,
    Lightbulb,
    Heart,
    TimeAgo
    },
    data() {
        return initialState();
    },
    watch: {
        //
    },
    computed: {
        socket_data: function() {
            return this.items.sort((a, b) => new Date(a.created_at) - new Date(b.created_at))
        }
    },
    methods: {
        socketConnect: function () {
            this.authorize();
        },
        logout :  function(){
             axios({
                    method: "POST",
                    url: "/iot/v1/logout",
                    headers: {
                        Authorization: `Bearer ${this.device_token}`,
                    }
                })
                .then((response) => {
                    Object.assign(this.$data, initialState());
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        switchVisibility() {
            this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
        },
        clearSocketData: function () {
            this.socket_data = [];
        },
        msg: function (type = 'success', message) {
            Swal.fire({
                position: 'top-end',
                icon: type,
                showConfirmButton: false,
                timer: 1500,
                text: message
            })
        },
        notify : function(msg){
            this.$toast.success(msg, {
            });
        },
        error : function(msg){
            this.$toast.error(msg, {
            });
        },
        warning : function(msg){
            this.$toast.warning(msg, {
            });
        },
        authorize: function () {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios
                    .post("/iot/v1/login", {
                        public_key: this.public_key,
                        private_key: this.private_key,
                    } , {withCredentials: true})
                    .then(({
                        data
                    }) => {
                        this.device_token = data.token;
                        this.device_id = data.device_id;
                        window.localECHO = new Echo({
                            broadcaster: "pusher",
                            key: process.env.MIX_PUSHER_APP_KEY,
                            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
                            forceTLS: false,
                            wsHost: window.location.hostname,
                            wsPort: 6001,
                            disableStats: true,
                            enabledTransports: ['ws', 'wss'], // <- added this param
                            authorizer: (channel, options) => {
                                console.log(options, channel);
                                return {
                                    authorize: (socketId, callback) => {
                                        axios({
                                                method: "POST",
                                                url: "/api/broadcasting/auth",
                                                headers: {
                                                    Authorization: `Bearer ${this.device_token}`,
                                                },
                                                data: {
                                                    socket_id: socketId,
                                                    channel_name: channel.name,
                                                },
                                            })
                                            .then((response) => {
                                                console.log(response);
                                                this.msg("success", "Connected")
                                                this.authorized = true;
                                                callback(false, response.data);
                                            })
                                            .catch((error) => {
                                                console.log(error);
                                                this.authorized = false;
                                                this.msg("error", "Failed To Connect")
                                                callback(true, error);
                                            });
                                    },
                                };
                            },
                        });
                        localECHO.private(`App.Device.${this.device_id}`)
                            .listen(
                                ".send_data_event",
                                (e) => {
                                    this.socket_data.push(e);
                                    this.handelResposne(e)
                                }
                            );
                    }).catch((error) => {
                        this.msg("error", "Failed To Connect")
                    });
            });
        },
        handelResposne : function(e){
            this.handelBulb(e)
            this.handelTemprature(e)
            this.handelHeartBeat(e)
        },
        handelBulb : function(data){
            if(this.socketPayloadContainsKey(data.payload , "light_is_on")){
                let light_before = this.light_is_on;
                this.light_is_on = data.payload.light_is_on;
                if(light_before != this.light_is_on)
                    if(this.light_is_on)
                        this.notify("Light is ON")
                    else
                        this.warning("Light is Off")
            }
        },
        handelTemprature : function(data){
            if(this.socketPayloadContainsKey(data.payload , "temperature_value")){
                this.temperature_value = data.payload.temperature_value;
            }
        },
        handelHeartBeat : function(data){
            if(this.socketPayloadContainsKey(data.payload , "bpm_value")){
                let bpm_before = this.bpm_value;
                this.bpm_value = data.payload.bpm_value;
                this.bpm_value == 0 ? this.heart_stop = true : this.heart_stop = false;
                if(this.bpm_value != bpm_before && this.bpm_value == 0 )
                    this.error("Heart is Stopped!!!!")
            }
        },
        socketPayloadContainsKey(payload,key) {
            return Object.keys(payload).includes(key);
        }
    },
    created() {
        //
    },
};
</script>
