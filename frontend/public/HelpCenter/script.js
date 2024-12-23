<script>
  document.querySelectorAll('.faq-question').forEach(button = {
    button.addEventListener('click', () => {
      const active = document.querySelector('.faq-question.active');
      if (active && active !== button) {
        active.classList.remove('active');
        active.nextElementSibling.style.maxHeight = null;
      }

      button.classList.toggle('active');
      const answer = button.nextElementSibling;
      if (button.classList.contains('active')) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
      } else {
        answer.style.maxHeight = null;
      }
    })
  });
</script>
