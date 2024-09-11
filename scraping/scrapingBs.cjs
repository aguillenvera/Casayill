// scraper.js


const scrappingBCV = async (url) => {
  const browser = await chromium.launch({ headless: true });
  const browserContext = await browser.newContext();
  try {
    const page = await browserContext.newPage();
    await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page.waitForTimeout(5000);
    const results = await page.$eval('body', async (body) => {
      const divDolar = document.getElementById('dolar');
      const values = divDolar.textContent.match(/\d+,\d+/);

      const Money = values[0].replace(',', '.');

      return Money;
    });
    console.log(results);
    return results;
  } catch (err) {
    console.log(err);
  } finally {
    await browser.close();
  }
};

module.exports = scrappingBCV;
