import { useState } from 'react';
import Carousel from 'react-bootstrap/Carousel';
import './HomePage.css'; // Ensure you import your CSS file
import styles from './HomePageStyles';

function ControlledCarousel() {
  const [index, setIndex] = useState(0);

  const handleSelect = (selectedIndex) => {
    setIndex(selectedIndex);
  };

  return (
    <div style={styles.featuredCampaigns}>
      <h2>Our Works</h2>
      <div className="carousel-section">
        <Carousel activeIndex={index} onSelect={handleSelect} interval={2000}> 
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/carousel/carousel1.jpg" // Replace with your actual image path
              alt="Fundraiser 1"
            />
            <Carousel.Caption>
              <h3>Health for All Campaign</h3>
              <p>Raised $25,000 to provide medical supplies to rural clinics</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/carousel/carousel2.jpg" // Replace with your actual image path
              alt="Fundraiser 2"
            />
            <Carousel.Caption>
              <h3>Wildlife Conservation Fund</h3>
              <p>Raised $20,000 to protect endangered species in local habitats.</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/carousel/carousel3.jpg" // Replace with your actual image path
              alt="Fundraiser 3"
            />
            <Carousel.Caption>
              <h3>Clean Water for Communities</h3>
              <p>Funded $30,000 to install water purification systems in villages..</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/carousel/carousel4.jpg" // Replace with your actual image path
              alt="Fundraiser 4"
            />
            <Carousel.Caption>
              <h3>Hurricane Relief Fundraiser</h3>
              <p>Generated $50,000 to provide emergency aid to hurricane victims</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/carousel/carousel5.jpg" // Replace with your actual image path
              alt="Fundraiser 5"
            />
            <Carousel.Caption>
              <h3>Books for All Campaign</h3>
              <p>Raised $12,000 to provide books and resources to underfunded schools.</p>
            </Carousel.Caption>
          </Carousel.Item>
        </Carousel>
      </div>
    </div>
  );
}

export default ControlledCarousel;