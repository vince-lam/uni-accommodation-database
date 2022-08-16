/* Find number of students who have have a current status of waiting and placed. */

SELECT
  SUM(CASE WHEN current_status = 'waiting' THEN 1 ELSE 0 END) AS waiting_count,
  SUM(CASE WHEN current_status = 'placed' THEN 1 ELSE 0 END) AS placed_count,
  COUNT(*) AS total_students
FROM `student`;

/* Get list of students who are waiting to be placed. */
SELECT *
FROM `student`
WHERE current_status = 'waiting';

/* Get list of available accomodations, that do not have a current lease agreement and show monthly rent */
SELECT 
	room.room_id
    ,room_description
    ,bed_size
    ,ensuite
    ,building_id
    ,monthly_rent
FROM room
LEFT JOIN lease_agreement ON room.room_id = lease_agreement.room_id
LEFT JOIN room_type ON room.room_type_id = room_type.room_type_id
WHERE lease_agreement.room_id IS NULL

/* Get count of all rooms occupied per halls*/
SELECT 
	halls_of_residence_name
    , COUNT(*) building_count
FROM building b
LEFT JOIN halls h ON b.halls_id = h.halls_id
GROUP BY halls_of_residence_name


/* Get count of all buildings per hall*/
SELECT 
	halls_of_residence_name
    , COUNT(*) building_count
FROM building b
LEFT JOIN halls h ON b.halls_id = h.halls_id
GROUP BY halls_of_residence_name

/* Get count of all rooms per building per hall */
SELECT
	h.halls_of_residence_name
    , COUNT(DISTINCT b.building_id) building_count
    , COUNT(r.room_id) room_count
FROM room r
LEFT JOIN building b ON r.building_id = b.building_id
LEFT JOIN halls h ON b.halls_id = h.halls_id
GROUP BY halls_of_residence_name


SELECT
	h.halls_of_residence_name
    , building_name
    , COUNT(r.room_id) room_count
FROM room r
LEFT JOIN building b ON r.building_id = b.building_id
LEFT JOIN halls h ON b.halls_id = h.halls_id
GROUP BY halls_of_residence_name, building_name

/* What is percentage of rooms leased grouped by hall. */
WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
) 
SELECT 
	halls_name
	,100.0 * SUM(CASE WHEN lease_id IS NOT NULL THEN 1 ELSE 0 END) / COUNT(*) AS perc_rooms_leased
FROM all_rooms_CTE
GROUP BY halls_name


/* What is percentage of rooms leased grouped by hall and building. */

WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
) 
SELECT 
	halls_name
    ,building_name
	,100.0 * SUM(CASE WHEN lease_id IS NOT NULL THEN 1 ELSE 0 END) / COUNT(*) AS perc_rooms_leased
FROM all_rooms_CTE
GROUP BY halls_name, building_name


/* Semester rental revenue. */



/* Total monthly rent by hall */
WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
) 
SELECT 
	halls_name
	,ROUND(SUM(monthly_rent), 2) total_monthly_rent_rounded
FROM all_rooms_CTE
WHERE lease_id IS NOT NULL
GROUP BY halls_name
ORDER BY 2 DESC

/* Total monthly rent by hall with rank*/
WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
)
    SELECT 
        halls_name
        ,ROUND(SUM(monthly_rent), 2) 
        ,RANK() OVER (ORDER BY ROUND(SUM(monthly_rent), 2)   DESC)
    FROM all_rooms_CTE
    WHERE lease_id IS NOT NULL
    GROUP BY halls_name
    ORDER BY 3 

/* Total monthly rent by hall and building with rank and count of rooms*/
WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
)
    SELECT 
        halls_name
        ,building_name
        ,COUNT(*) count_of_rooms_rented
        ,ROUND(SUM(monthly_rent), 2) monthly_rent
        ,RANK() OVER (ORDER BY ROUND(SUM(monthly_rent), 2) DESC) rank_by_monthly_rent_generated
    FROM all_rooms_CTE
    WHERE lease_id IS NOT NULL
    GROUP BY halls_name, building_name
    ORDER BY 4 DESC



/* Total lost monthly rent by hall */
WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
) 
SELECT 
	halls_name
	,ROUND(SUM(monthly_rent), 2) total_lost_monthly_rent_rounded
FROM all_rooms_CTE
WHERE lease_id IS NULL
GROUP BY halls_name
ORDER BY 2 DESC



/* Rank buildings by amount of rent lost and get count of rooms not rented out*/

WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
)
    SELECT 
        halls_name
        ,building_name
        ,COUNT(*) count_of_rooms_not_rented
        ,ROUND(SUM(monthly_rent), 2) total_monthly_rent_lost
        ,RANK() OVER (ORDER BY ROUND(SUM(monthly_rent), 2) DESC) rank_by_monthly_rent_lost
    FROM all_rooms_CTE
    WHERE lease_id IS NULL
    GROUP BY halls_name, building_name
    ORDER BY 4 DESC





/* Get list of rooms that due an inspection - either have never had an inspection or their condition is not satisfactory */

SELECT *
FROM room r 
LEFT JOIN inspection i ON r.room_id=i.room_id
WHERE inspection_id IS NULL 
OR satisfactory_condition != 1
OR inspection_date < '2021-01-01'

/* Group buildings by number of rooms to be inspected, to improve efficiency of inspections - either have never had an inspection or their condition is not satisfactory */
SELECT 
    h.halls_of_residence_name
    ,b.building_name
    ,COUNT(r.room_id) rooms_to_be_inspected
FROM room r
LEFT JOIN building b ON r.building_id = b.building_id
LEFT JOIN halls h ON b.halls_id = h.halls_id
LEFT JOIN inspection i ON r.room_id=i.room_id
WHERE inspection_id IS NULL
OR satisfactory_condition != 1
OR inspection_date < '2021-01-01'
GROUP BY b.building_name, h.halls_of_residence_name

/* Group halls by number of rooms to be inspected, to improve efficiency of inspections - either have never had an inspection or their condition is not satisfactory */
SELECT 
    h.halls_of_residence_name
    ,COUNT(r.room_id) rooms_to_be_inspected
FROM room r
LEFT JOIN building b ON r.building_id = b.building_id
LEFT JOIN halls h ON b.halls_id = h.halls_id
LEFT JOIN inspection i ON r.room_id=i.room_id
WHERE inspection_id IS NULL
OR satisfactory_condition != 1
OR inspection_date < '2021-01-01'
GROUP BY h.halls_of_residence_name



/* Find YAHUAS with the most inspections for the past year*/















----------------------------------------------

example

WITH revenue0(supplier_no , total_revenue) AS (
    SELECT l_suppkey, SUM(l_extendedprice * (1 - l_discount))
    FROM lineitem
    WHERE l_shipdate >= '1996-07-01'
      AND l_shipdate < DATE_ADD('1996-07-01', INTERVAL '90' DAY)
    GROUP BY l_suppkey )
SELECT s_suppkey, s_name, s_address, s_phone, total_revenue
FROM supplier, revenue0
WHERE s_suppkey = supplier_no
  AND total_revenue = (SELECT MAX(total_revenue) FROM revenue0)
ORDER BY s_suppkey;



WITH counts(waiting, placed, total) AS (
    SELECT
      SUM(CASE WHEN current_status = 'waiting' THEN 1 ELSE 0 END),
      SUM(CASE WHEN current_status = 'placed' THEN 1 ELSE 0 END),
      COUNT(*)
    FROM yahuas.`student`
) SELECT *
FROM counts








WITH all_rooms_CTE(room_id,building_id,building_name,halls_id,halls_name,monthly_rent,lease_id) AS (
    SELECT 
    	r.room_id
    	,r.building_id
    	,b.building_name
    	,b.halls_id
    	,h.halls_of_residence_name
    	,r.monthly_rent
    	,l.lease_id
    FROM room r
    LEFT JOIN building b ON r.building_id = b.building_id
    LEFT JOIN halls h ON b.halls_id = h.halls_id
    LEFT JOIN lease_agreement l ON r.room_id = l.room_id
) ,
rent_grouped(halls_name, rent_lost) AS (
    SELECT 
        halls_name
        ,ROUND(SUM(monthly_rent), 2) 
    FROM all_rooms_CTE
    WHERE lease_id IS NOT NULL
    GROUP BY halls_name
)
SELECT 
	halls_name
    ,rent_lost
    ,RANK() OVER (ORDER BY rent_lost DESC)
FROM rent_grouped
