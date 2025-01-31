<div style="margin: 0; padding: 0; background-color: #f4f7fc; font-family: Arial, sans-serif;">

  <div style="display: flex; justify-content: center; align-items: center; height: 100vh; padding: 0 15px;">
      <div style="background: linear-gradient(145deg, #ff4b2b, #ff416c); color: white; padding: 30px 40px; border-radius: 12px; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); text-align: center; width: 100%; max-width: 400px; animation: fadeIn 1s ease-out;">
          <div style="font-size: 60px; margin-bottom: 20px; animation: bounce 1s infinite;">
              ✔
          </div>
          <h2 style="font-size: 28px; margin: 0; font-weight: bold; letter-spacing: 1px; margin-bottom: 15px;">Payment Failed!</h2>
          <p style="font-size: 18px; margin-top: 10px; opacity: 0.9;">Oops, something went wrong. Your payment was not processed. Please try again.</p>
      </div>
  </div>

  <style>
      @keyframes fadeIn {
          0% { opacity: 0; transform: translateY(-20px); }
          100% { opacity: 1; transform: translateY(0); }
      }

      @keyframes bounce {
          0%, 20%, 50%, 80%, 100% {
              transform: translateY(0);
          }
          40% {
              transform: translateY(-10px);
          }
          60% {
              transform: translateY(-5px);
          }
      }

      @media (max-width: 600px) {
          div[style*="background"] {
              padding: 25px 20px;
          }
          div[style*="font-size: 60px;"] {
              font-size: 50px;
          }
          h2 {
              font-size: 24px;
          }
          p {
              font-size: 16px;
          }
      }
  </style>

</div>