<template>
  <div class="heart_card">
    <div class="heart-group">
      <div v-bind:class="{ 'circle-ripple' : true, 'stop' : heart_stop == true ,  'beat' : heart_stop == false }"></div>
      <div class="heart">
        <svg
        v-bind:class="{ 'heart-icon' : true, 'stop' : heart_stop == true ,  'beat' : heart_stop == false }"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="22"
          viewBox="0 0 24 22"
        >
          <path
            fill="#FFF"
            fill-rule="evenodd"
            d="M40,31.1111114 C40,27.736038 37.3137085,25 34,25 C31.4,25 28.84,26.7111115 28,29.0740744 C27.16,26.6703707 24.6,25 22,25 C18.7477829,24.9988224 16.0867256,27.6368829 16,30.9481484 L16,31.1111114 C16.0011761,31.7331755 16.0955974,32.3514103 16.28,32.9444447 C17.64,38.1185187 23.76,43.3740741 28,47 C32.24,43.4148149 38.32,37.751852 39.68,32.9851854 C39.7670252,32.7053391 39.8338696,32.4193934 39.88,32.1296299 L39.88,32.0074077 C39.9262163,31.7244707 39.9529482,31.4385881 39.96,31.1518521 L40,31.1111114 Z"
            transform="translate(-16 -25)"
          />
        </svg>
      </div>
    </div>
    <h2>{{ bpm_value }}</h2>
    <p>bpm</p>
    <h1>Heart Rate</h1>
  </div>
</template>
<script>
export default {
  props: {
    bpm_value: 0,
    heart_stop: false,
  },
};
</script>

<style>
.heart_card {
  position: relative;
  width: 186px;
  height: 171px;
  background: #ee462b;
  box-shadow: 0 7px 8px -4px rgba(148, 13, 0, 0.2),
    0 12px 17px 2px rgba(148, 13, 0, 0.14),
    0 5px 22px 4px rgba(148, 13, 0, 0.12);
  border-radius: 10px;
  overflow: hidden;
}
.heart_card .heart {
  position: relative;
  margin-top: 25px;
  margin-left: 16px;
}
.heart_card .heart-icon {
  fill: #fff;
  animation: beat 0.5s infinite alternate;
  transform-origin: center;
}
.heart_card .circle-ripple {
  position: absolute;
  left: 24px;
  top: 30.5px;
  background-color: #fff;
  width: 0.5em;
  height: 0.5em;
  border-radius: 50%;
  animation: ripple 0.5s linear infinite;
}

.heart_card .stop{
    animation-play-state: paused;
}

.heart_card .beat{
    animation-play-state: running;
}

.heart_card h2 {
  display: inline-block;
  font-size: 40px;
  color: #fff;
  letter-spacing: 0.52px;
  line-height: 34px;
  margin-top: 13px;
  font-weight: 300;
  margin-left: 16px;
  margin-bottom: 0;
  z-index: 2;
  position: relative;
}
.heart_card p {
  font-size: 16px;
  color: rgba(235, 235, 245, 0.6);
  letter-spacing: -0.32px;
  line-height: 21px;
  margin-top: 6px;
  margin-left: 16px;
  margin-bottom: 0;
  z-index: 2;
  position: relative;
}
.heart_card h1 {
  font-size: 17px;
  color: #fff;
  letter-spacing: -0.41px;
  line-height: 22px;
  margin-top: 4px;
  margin-left: 16px;
  margin-bottom: 0;
  font-weight: 600;
  z-index: 2;
  position: relative;
}
@keyframes ripple {
  0% {
    box-shadow: 0 0 0 0 rgba(148, 13, 0, 0.15), 0 0 0 1em rgba(148, 13, 0, 0.15),
      0 0 0 5em rgba(148, 13, 0, 0.15), 0 0 0 10em rgba(148, 13, 0, 0.15);
  }
  100% {
    box-shadow: 0 0 0 1em rgba(148, 13, 0, 0.15),
      0 0 0 5em rgba(148, 13, 0, 0.15), 0 0 0 10em rgba(148, 13, 0, 0.15),
      0 0 0 12em rgba(148, 13, 0, 0);
  }
}
@keyframes beat {
  to {
    transform: scale(1.4);
  }
}
</style>
