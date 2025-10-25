import defaultTheme from 'tailwindcss/defaultTheme'

export default {
  content: ['./resources/**/*.blade.php','./resources/**/*.js','./resources/**/*.vue'],
  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
      },
      colors: { desa: { brand: '#2C7961' } }
    },
  },
  plugins: [],
}
