<template>
    <div id="app" class="center">
      <div class="book" ref="book">
        <div id="pages" class="pages">
          <div v-for="pageNumber in totalPages" :key="pageNumber" class="page" @click="toggleFlip(pageNumber)" :style="{ backgroundImage: `url(${getPageImagePath(pageNumber)})` }">
            <img class="gallery-image" :src="getPageImagePath(pageNumber)" alt="Page Image" style="top: 10%; left: 10%;" />
            <img class="gallery-image" :src="getPageImagePath(pageNumber)" alt="Page Image" style="top: 10%; left: 50%;" />
            <img class="gallery-image" :src="getPageImagePath(pageNumber)" alt="Page Image" style="top: 50%; left: 10%;" />
            <img class="gallery-image" :src="getPageImagePath(pageNumber)" alt="Page Image" style="top: 50%; left: 50%;" />
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        totalPages: 14, // Change this to the desired number of pages
      };
    },
    mounted() {
      this.setZIndex();
    },
    methods: {
      setZIndex() {
        const pages = this.$refs.book.querySelectorAll('.page');
        for (let i = 0; i < pages.length; i++) {
          const page = pages[i];
          if (i % 2 === 0) {
            page.style.zIndex = pages.length - i;
          }
        }
      },
      getPageImagePath(pageNumber) {
        return `http://10.169.142.41:81//public/img/Book/page${pageNumber}.png`;
      },
      toggleFlip(pageNum) {
        const currentPage = this.$refs.book.querySelector(`.page:nth-child(${pageNum})`);
        const nextSibling = pageNum % 2 === 0 ? currentPage.previousElementSibling : currentPage.nextElementSibling;

        if (pageNum % 2 === 0) {
          currentPage.classList.remove('flipped');
          nextSibling.classList.remove('flipped');
        } else {
          currentPage.classList.add('flipped');
          nextSibling.classList.add('flipped');
        }
      },
    },
  };
  </script>

  <style scoped>
  .center {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  .book {
    perspective: 250vw;
  }

  .pages {
    width: 60vw;
    height: 38vw;
    position: relative;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    border-radius: 4px;
    margin: auto; /* Centering horizontally */
  }
  .gallery-image {
    width: 30%;
    height: 30%;
    position: absolute;
  }
  .page {
    float: none;
    clear: none;
    margin: 0;
    position: absolute;
    top: 0;
    width: 30vw;
    height: 44vw;
    transform-origin: 0 0;
    transition: transform 1.4s;
    backface-visibility: hidden;
    transform-style: preserve-3d;
    cursor: pointer;
    user-select: none;
    background-color: #f0f0f0;
    background-size: cover;
    background-position: center;
    transform: translate(-50%, -50%); /* Centering both horizontally and vertically */
  }

  .page:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.7s;
    z-index: 2;
  }

  .page:nth-child(odd) {
    pointer-events: all;
    transform: rotateY(0deg);
    right: 0;
    border-radius: 0 4px 4px 0;
    background-image: linear-gradient(to right, rgba(0,0,0,.15) 0%, rgba(0,0,0,0) 10%);
  }

  .page:nth-child(odd):hover {
    transform: rotateY(-15deg);
  }

  .page:nth-child(odd):hover:before {
    background: rgba(0, 0, 0, 0.03);
  }

  .page:nth-child(odd):before {
    background: rgba(0, 0, 0, 0);
  }

  .page:nth-child(even) {
    pointer-events: none;
    transform: rotateY(180deg);
    transform-origin: 100% 0;
    left: 0;
    border-radius: 4px 0 0 4px;
    border-color: black;
    background-image: linear-gradient(to left, rgba(0,0,0,.12) 0%, rgba(0,0,0,0) 10%);
  }

  .page:nth-child(even):before {
    background: rgba(0, 0, 0, 0.2);
  }

  .page.grabbing {
    transition: none;
  }

  .page.flipped:nth-child(odd) {
    pointer-events: none;
    transform: rotateY(-180deg);
  }

  .page.flipped:nth-child(odd):before {
    background: rgba(0, 0, 0, 0.2);
  }

  .page.flipped:nth-child(even) {
    pointer-events: all;
    transform: rotateY(0deg);
  }

  .page.flipped:nth-child(even):hover {
    transform: rotateY(15deg);
  }

  .page.flipped:nth-child(even):hover:before {
    background: rgba(0, 0, 0, 0.03);
  }

  .page.flipped:nth-child(even):before {
    background: rgba(0, 0, 0, 0);
  }
  </style>
