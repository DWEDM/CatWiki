<style>
    .card {
    box-sizing: border-box;
    width: 79vw;
    height: 80vh;
    background-color: #89ECBC;
    border: 1px solid white;
    box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
    backdrop-filter: blur(6px);
    border-radius: 17px;
    text-align: center;
    cursor: pointer;
    transition: all 0.5s;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    font-weight: bolder;
    color: black;
    }

    .card:hover {
    border: 1px solid black;
    transform: scale(1.05);
    }

    .card:active {
    transform: scale(0.95) rotateZ(1.7deg);
    }

    .card-image{
      width: relative;
      height: 100%;

      background: url(assets/resources/5.jpg);
      background-position: center;
      background-size: cover;
    }
  
</style>

<div class="card"  style="overflow: hidden;">
  <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
      <div class="card-image object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"></div>
      <div class="flex flex-col justify-between p-4 leading-normal">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
      </div>
  </a>
</div>