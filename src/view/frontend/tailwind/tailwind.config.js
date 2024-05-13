console.log(`
👁 Purge TailwindCss @ Hyva_MageplazaGiftWrap..
`);

module.exports = {
  content: [
    '../**/*.phtml',
  ],
  safelist: [
    'lg:sticky',
    'lg:h-full',
    'lg:h-[100vh]',
    'lg:overflow-y-scroll',
    'lg:top-0',
    'max-h-[320px]',
    'max-h-[480px]'
  ]
}
