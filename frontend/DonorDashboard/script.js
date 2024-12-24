// Sample data for donation history
const donationHistory = [
    { date: '2023-10-01', campaign: 'Save the Rainforest', amount: '$50' },
    { date: '2023-09-15', campaign: 'Help Homeless Families', amount: '$100' },
    { date: '2023-08-20', campaign: 'Support Local Schools', amount: '$75' },
];

// Function to populate donation history
function populateDonationHistory() {
    const tableBody = document.getElementById('donationHistory');
    donationHistory.forEach(donation => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${donation.date}</td>
            <td>${donation.campaign}</td>
            <td>${donation.amount}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Call the function to populate the table
populateDonationHistory();