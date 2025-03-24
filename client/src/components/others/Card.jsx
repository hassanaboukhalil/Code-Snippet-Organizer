import Button from "./Button";

const Card = ({ title, tags, keywords, code }) => {
  return (
    <div className="card bg-white">
      <div className="flex flex-column gap-2">
        <h3 className="h3">{title}</h3>
        <div>
          <p className="body2">{keywords}</p>
          <p className="body2">{tags}</p>
          <p className="body2">{code}</p>
        </div>
        <div className="flex flex-wrap gap-2">
          {/* <Button text="Edit" onClick={() => setIsEditing(true)} /> */}
          <Button text="Delete" classes={"btn-danger"} />
        </div>
      </div>
    </div>
  );
};
export default Card;
