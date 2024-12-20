import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './Testimonial.css'; // Assuming you create a separate CSS file for custom styles

const testimonials = [
    {
        name: "Alice Johnson",
        role: "Entrepreneur",
        testimonial: "This crowdfunding platform helped me raise the funds I needed to launch my startup. The community support was incredible!",
        image: "https://th.bing.com/th/id/OIP.OUruZMA7_BwAkDVzHvD_oQHaK3?pid=ImgDet&w=184&h=270&c=7&dpr=1.3",
        rating: 5
    },
    {
        name: "Bob Smith",
        role: "Non-Profit Organizer",
        testimonial: "I was able to gather donations for my charity project in no time. The platform is user-friendly and effective.",
        image: "https://th.bing.com/th/id/OIP.vhm3qJupqdo9Afdj5MzKyQHaLF?w=641&h=960&rs=1&pid=ImgDetMain",
        rating: 4
    },
    {
        name: "Charlie Brown",
        role: "Artist",
        testimonial: "Thanks to this platform, I was able to fund my art project and connect with amazing supporters. Highly recommend!",
        image: "https://th.bing.com/th/id/OIP.pjwsh9j0RLQLuLoSoGNSUQHaJj?w=736&h=949&rs=1&pid=ImgDetMain",
        rating: 5
    }
];

const Testimonial = () => {
    return (
        <div className="container mt-5">
            <h2 className="text-center mb-4">What Our Users Say</h2>
            <div className="row">
                {testimonials.map((testimonial, index) => (
                    <div className="col-md-4" key={index}>
                        <div className="card mb-4 shadow-sm testimonial-card">
                            <img src={testimonial.image} className="card-img-top" alt={testimonial.name} />
                            <div className="card-body">
                                <h5 className="card-title">{testimonial.name}</h5>
                                <h6 className="card-subtitle mb-2 text-muted">{testimonial.role}</h6>
                                <div className="star-rating mb-2">
                                    {Array.from({ length: 5 }, (_, i) => (
                                        <span key={i} className={i < testimonial.rating ? "star filled" : "star"}>★</span>
                                    ))}
                                </div>
                                <p className="card-text">{testimonial.testimonial}</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Testimonial;