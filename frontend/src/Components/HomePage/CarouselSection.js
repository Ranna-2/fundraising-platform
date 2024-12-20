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
              src="/images/refugee4.jpg" // Replace with your actual image path
              alt="Fundraiser 1"
            />
            <Carousel.Caption>
              <h3>Fundraiser 1 Title</h3>
              <p>Description for Fundraiser 1.</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/featured_healthcare.jpg" // Replace with your actual image path
              alt="Fundraiser 2"
            />
            <Carousel.Caption>
              <h3>Fundraiser 2 Title</h3>
              <p>Description for Fundraiser 2.</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/environment6.jpg" // Replace with your actual image path
              alt="Fundraiser 3"
            />
            <Carousel.Caption>
              <h3>Fundraiser 3 Title</h3>
              <p>Description for Fundraiser 3.</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/animals1.jpg" // Replace with your actual image path
              alt="Fundraiser 4"
            />
            <Carousel.Caption>
              <h3>Fundraiser 4 Title</h3>
              <p>Description for Fundraiser 4.</p>
            </Carousel.Caption>
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100 carousel-image"
              src="/images/animals6.jpg" // Replace with your actual image path
              alt="Fundraiser 5"
            />
            <Carousel.Caption>
              <h3>Fundraiser 5 Title</h3>
              <p>Description for Fundraiser 5.</p>
            </Carousel.Caption>
          </Carousel.Item>
        </Carousel>
      </div>
    </div>
  );
}

export default ControlledCarousel;