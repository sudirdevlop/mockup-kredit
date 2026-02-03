export function calculateMonthlyPayment(principal, annualRate, months) {
  const monthlyRate = annualRate / 100 / 12
  const payment = principal * (monthlyRate * Math.pow(1 + monthlyRate, months)) / 
                  (Math.pow(1 + monthlyRate, months) - 1)
  return Math.round(payment)
}

export function calculateTotalPayment(monthlyPayment, months) {
  return monthlyPayment * months
}

export function calculateTotalInterest(totalPayment, principal) {
  return totalPayment - principal
}

export function generateAmortizationSchedule(principal, annualRate, months) {
  const monthlyRate = annualRate / 100 / 12
  const monthlyPayment = calculateMonthlyPayment(principal, annualRate, months)
  
  let balance = principal
  const schedule = []
  
  for (let month = 1; month <= months; month++) {
    const interestPayment = balance * monthlyRate
    const principalPayment = monthlyPayment - interestPayment
    balance -= principalPayment
    
    schedule.push({
      month,
      payment: monthlyPayment,
      principal: principalPayment,
      interest: interestPayment,
      balance: Math.max(0, balance)
    })
  }
  
  return schedule
}
