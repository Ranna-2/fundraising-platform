const styles = {
  // General container styles
  container: {
      fontFamily: 'Arial, sans-serif',
      margin: 0,
      padding: 0,
  },

  // Hero section styles
  hero: {
      position: 'relative',
      backgroundImage: 'url(/images/background.png)', 
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      height: '100vh', 
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      color: '#fff', 
      position : 'relative',
      padding : '20px',
  },
  heroOverlay: {
      position: 'absolute',
      top: 0,
      left: 0,
      width: '100%',
      height: '100%',
      background: 'rgba(0, 0, 0, 0.5)', 
      zIndex: 1, 
  },
  heroTitle: {
      fontSize: '3rem',
      fontWeight: 'bold',
      marginBottom: '1rem',
  },
  heroContent: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center', 
      zIndex: 1, 
  },

  heroSubtitle: {
      fontSize: '1.5rem',
      marginBottom: '2rem',
  },

  // Search bar styles
  searchBar: {
      marginTop: '20px',
      padding: '1rem',
      backgroundColor: '#f9f9f9',
      borderRadius: '8px',
      zIndex :3,
      position: 'relative',
      width: '100%',
  },

  // Call to action button styles
  ctaButton: {
      margin: '0 10px',
      padding: '20px 30px',
      fontSize: '1rem',
      fontWeight: 'bold',
      color: '#fff',
      backgroundColor: '#28a745',  
      borderColor: '#28a745',     
      borderRadius: '12px',
      cursor: 'pointer',
      transition: 'background-color 0.3s, transform 0.2s',
  },
  ctaButtonHover: {
      backgroundColor: '#1e8b5f',  
      transform: 'scale(1.05)',     
  },

  buttonContainer: {
    marginTop: '20px', 
    zIndex: 2, 
    marginBottom: '20px',
},


  
  ctaButtonOutline: {
      margin: '0 10px',
      padding: '20px 30px',
      fontSize: '1rem',
      fontWeight: 'bold',
      color: '#28a745', 
      backgroundColor: 'transparent', 
      borderColor: '#28a745', 
      borderRadius: '12px',
      cursor: 'pointer',
      transition: 'background-color 0.3s, transform 0.2s',
  },
  ctaButtonOutlineHover: {
      backgroundColor: '#28a745',  
      color: '#fff',              
  },

  // Features section styles
  features: {
      display: 'flex',
      justifyContent: 'space-around',
      padding: '2rem',
      background: '#f9f9f9',
  },
  featureCard: {
      textAlign: 'center',
      width: '30%',
  },
  featureIconContainer: {
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      height: '100px', 
      marginBottom: '15px',
  },
  featureImage: {
      maxWidth: '80px',      
      maxHeight: '80px',    
      width: 'auto',         
      height: 'auto',        
      objectFit: 'contain',  
  },

  // Campaigns section styles
  campaigns: {
      padding: '2rem',
  },
  campaignCard: {
      display: 'flex',
      marginBottom: '1rem',
  },
  campaignImage: {
      width: '40%',
      marginRight: '1rem',
      borderRadius: '8px',
  },
  campaignContent: {
      textAlign: 'left',
  },

  // Footer styles
  footer: {
      padding: '1rem',
      textAlign: 'center',
      background: '#333',
      color: '#fff',
  },

  // Featured campaigns section styles
  featuredCampaigns: {
      padding: '2rem',
      backgroundColor: '#f9f9f9',
      textAlign: 'center',
  },
  campaignsContainer: {
      display: 'flex',
      justifyContent: 'space-between',
      gap: '20px',
  },

  // Donate button styles
  donateButton: {
      backgroundColor: '#28a745',
      color: 'white',
      border: 'none',
      padding: '10px 20px',
      borderRadius: '5px',
      cursor: 'pointer',
      transition: 'background-color 0.3s',
      
  },
};

export default styles;