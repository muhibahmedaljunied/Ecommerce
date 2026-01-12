const puppeteer = require('puppeteer');
const fs = require('fs');
(async () => {
  const htmlPath = process.argv[2] || 'reports/session_summary.html';
  const pdfPath = process.argv[3] || 'reports/session_summary.pdf';

  if (!fs.existsSync(htmlPath)) {
    console.error('HTML file not found:', htmlPath);
    process.exit(1);
  }

  const browser = await puppeteer.launch({ args: ['--no-sandbox', '--disable-setuid-sandbox'] });
  const page = await browser.newPage();
  const content = fs.readFileSync(htmlPath, 'utf8');
  await page.setContent(content, { waitUntil: 'networkidle0' });
  await page.pdf({ path: pdfPath, format: 'A4', printBackground: true });
  await browser.close();
  console.log('PDF generated at', pdfPath);
})();
