document.addEventListener('DOMContentLoaded', () => {
    const facebookBtn = document.querySelector('.btn-primary');
    const twitterBtn = document.querySelector('.btn-info');
    const whatsappBtn = document.querySelector('.btn-success');

    const campaignUrl = encodeURIComponent(window.location.href);
    const campaignTitle = encodeURIComponent("Check out this amazing campaign!");

    facebookBtn.addEventListener('click', () => {
        const fbUrl = `https://www.facebook.com/sharer/sharer.php?u=${campaignUrl}`;
        window.open(fbUrl, '_blank');
    });

    twitterBtn.addEventListener('click', () => {
        const twitterUrl = `https://twitter.com/intent/tweet?url=${campaignUrl}&text=${campaignTitle}`;
        window.open(twitterUrl, '_blank');
    });

    whatsappBtn.addEventListener('click', () => {
        const whatsappUrl = `https://api.whatsapp.com/send?text=${campaignTitle} ${campaignUrl}`;
        window.open(whatsappUrl, '_blank');
    });
});
