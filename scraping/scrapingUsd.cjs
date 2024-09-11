
const { chromium } = require('playwright');

const scrapping = async (url) => {
    const browser = await chromium.launch({ headless: true });
    const browserContext = await browser.newContext();
    try {
        const page = await browserContext.newPage();
        await page.goto(url, { waitUntil: "domcontentloaded", timeout: 60000 });
        await page.waitForTimeout(5000);
        const results = await page.$eval('body', async (body) => {
            const money = body.querySelector('p.result__BigRate-sc-1bsijpp-1.dPdXSB')
            const values = money.textContent.trim().split(" ")
            const Money =  values[0].replace(",", ".");
            return Money
        })
        return results
    } catch (err) {
        console.log(err)
    } finally {
        await browser.close()
    }
  }

  module.exports = scrapping;
