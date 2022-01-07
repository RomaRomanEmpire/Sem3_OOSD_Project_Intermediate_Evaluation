<?php

/**
 *
 */
class DivisionalSecretary extends R_A_P
{
    private $divisional_secretariat;

    public function __construct($attributeArray)
    {
        parent::__construct($attributeArray);

        $this->divisional_secretariat = $attributeArray['ds'];
        $this->db = DB_OP::get_connection();
        $this->u_type = "ds";
    }

    public function approve_application($application)
    {
        $application->approve($this->u_type);
    }

    /**
     * @throws Exception
     */
    public function getGnDivOrAddress()
    {
        throw new Exception("District Secretariat is not belong to one GN division");
    }

    /**
     * @return mixed
     */
    public function getDs()
    {
        return $this->ds;
    }
}


