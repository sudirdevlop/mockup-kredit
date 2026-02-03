export function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return re.test(email)
}

export function validatePhone(phone) {
  const re = /^(\+62|62|0)[0-9]{9,12}$/
  return re.test(phone)
}

export function validateNIK(nik) {
  return /^\d{16}$/.test(nik)
}

export function validateKTP(ktp) {
  return /^\d{16}$/.test(ktp)
}

export function validateRequired(value) {
  return value !== null && value !== undefined && value !== ''
}

export function validateMinLength(value, min) {
  return value && value.length >= min
}

export function validateMaxLength(value, max) {
  return value && value.length <= max
}

export function validateRange(value, min, max) {
  const num = Number(value)
  return !isNaN(num) && num >= min && num <= max
}
