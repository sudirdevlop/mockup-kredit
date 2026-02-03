export function formatCurrency(amount, currency = 'IDR') {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: currency,
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
  }).format(amount)
}

export function formatNumber(number) {
  return new Intl.NumberFormat('id-ID').format(number)
}

export function formatDate(date, format = 'long') {
  const options = {
    short: { year: 'numeric', month: 'short', day: 'numeric' },
    long: { year: 'numeric', month: 'long', day: 'numeric' },
    full: { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
  }
  
  return new Intl.DateTimeFormat('id-ID', options[format] || options.long).format(new Date(date))
}

export function formatPercent(value, decimals = 2) {
  return `${value.toFixed(decimals)}%`
}
