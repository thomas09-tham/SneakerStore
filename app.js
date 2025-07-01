const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Air Force",
    price: 119,
    colors: [
      {
        code: "black",
        img: "./img/Product/air.png",
      },
      {
        code: "darkblue",
        img: "./img/Product/air2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Air Jordan",
    price: 149,
    colors: [
      {
        code: "lightgray",
        img: "./img/product/jordan.png",
      },
      {
        code: "green",
        img: "./img/product/jordan2.png",
      },
    ],
  },
  {
    id: 3,
    title: "Blazer",
    price: 109,
    colors: [
      {
        code: "lightgray",
        img: "./img/product/blazer.png",
      },
      {
        code: "green",
        img: "./img/product/blazer2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Crater",
    price: 129,
    colors: [
      {
        code: "lightgray",
        img: "./img/product/crater.png",
      },
      {
        code: "green",
        img: "./img/product/crater2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Hippie",
    price: 99,
    colors: [
      {
        code: "lightgray",
        img: "./img/product/hippie.png",
      },
      {
        code: "green",
        img: "./img/product/hippie2.png",
      },
    ],
  },
  {
    id: 6,
    title: "Balls",
    price: 99,
    colors: [
      {
        code: "lightgray",
        img: "./img/product/Balls.png",
      },
    ],
  },
];

let chosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    wrapper.style.width = `${100 * products.length}vw`;
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    chosenProduct = products[index];
    currentProductTitle.textContent = chosenProduct.title;
    currentProductPrice.textContent = "RM" + chosenProduct.price;
    currentProductImg.src = chosenProduct.colors[0].img;

    currentProductColors.forEach((color, colorIndex) => {
      if (chosenProduct.colors[colorIndex]) {
        color.style.backgroundColor = chosenProduct.colors[colorIndex].code;
        color.style.display = "inline-block";
      } else {
        color.style.display = "none";
      }
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    if (chosenProduct.colors[index]) {
      currentProductImg.src = chosenProduct.colors[index].img;
    }
  });
});

currentProductSizes.forEach((size) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((s) => {
      s.style.backgroundColor = "white";
      s.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});

const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});
