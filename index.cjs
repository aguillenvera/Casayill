const   scrappingBCV  = require('./scraping/scrapingBs.cjs');
const  scrapping = require('./scraping/scrapingUsd.cjs');

 const express = require('express');
// import { express } from "express";
// import {mysql} from "mysql";
// import { firefox, chromium } from "playwright";
// import  dotenv from "dotenv";
// import { firefox, chromium } from "playwright";
const {chromium} = require("playwright");


const app = express();
const port = 3000;





app.get('/traer/usd', async (req, res)  => {
  const url = "https://www.xe.com/es/currencyconverter/convert/?Amount=1&From=USD&To=COP";
  const result =  await scrapping(url);
  res.status(200).send(result);
});

app.get('/traer/bs', async(req, res)=> {
  const  url ="https://www.bcv.org.ve"
  const result =  await scrappingBCV(url);
  res.status(200).send(result);

});
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
