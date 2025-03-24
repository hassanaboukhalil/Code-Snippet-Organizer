const Input = ({
  label,
  labelClasses,
  type,
  name,
  value,
  onChange,
  placeholder,
  classes,
  required,
}) => {
  return label ? (
    <div className="w-full">
      <label htmlFor={name} className={`${labelClasses}`}>
        {label}
      </label>
      <input
        type={type}
        name={name}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        className={`${classes}`}
        required={required}
      />
    </div>
  ) : (
    <input
      type={type}
      name={name}
      value={value}
      onChange={onChange}
      placeholder={placeholder}
      className={`${classes}`}
      required={required}
    />
  );
};

export default Input;
