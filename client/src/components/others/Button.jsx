import { Link } from "react-router-dom";

const Button = ({ text, path, onClick, classes, link_classes }) => {
  return (
    <>
      {path ? (
        <button
          className={`bg-primary body2 text-white btn flex flex-center ${classes}`}
          onClick={onClick}
          type="submit"
        >
          <Link to={path} className={`${link_classes}`}>
            {text}
          </Link>
        </button>
      ) : (
        <button
          className={`bg-primary body2 text-white btn flex flex-center ${classes}`}
          onClick={onClick}
        >
          <p>{text}</p>
        </button>
      )}
    </>
  );
};
export default Button;
